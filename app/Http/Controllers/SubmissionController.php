<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function create($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);

        if (!Auth::user()->teams->contains($assignment->team_id) && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('unauthorized');
        }

        return view('submission.create', compact('assignment'));
    }

    public function edit(Submission $submission)
    {
        // Prevent editing if the submission is approved (status = 1)
        if ($submission->approval_status === 1) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak dapat mengubah data yang sudah di approve.');
        }

        // Allow editing only if the authenticated user is the owner of the submission
        if (Auth::id() !== $submission->user_id) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak berwenang untuk mengubah data ini.');
        }

        return view('submission.edit', compact('submission'));
    }

    public function update(Request $request, Submission $submission)
    {
        $request->merge([
            'tgl_realisasi' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->tgl_realisasi)->format('Y-m-d'),
        ]);

        $request->validate([
            'link_tugas' => 'required|url',
            'tgl_realisasi' => 'required|date',
            'realisasi' => 'required|integer',
            'komentar' => 'nullable|string',
        ]);

        // Prevent updating if the submission is approved (status = 1)
        if ($submission->status === 1) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak dapat mengubah data yang sudah di approve.');
        }

        // Allow updating only if the authenticated user is the owner of the submission
        if (Auth::id() !== $submission->user_id) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak berwenang untuk mengubah data ini.');
        }

        $submission->update([
            'link_tugas' => $request->input('link_tugas'),
            'tgl_realisasi' => $request->input('tgl_realisasi'),
            'realisasi' => $request->input('realisasi'),
            'komentar' => $request->input('komentar'),
            'tgl_dikumpulkan' => now(),
        ]);

        return redirect()->route('assignments.index')->with('success', 'Submission updated successfully.');
    }

    public function store(Request $request)
    {
        // Validate the input first
        $validated = $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'tgl_realisasi' => 'required|date_format:m/d/Y', // Ensure it's a valid date in the correct format
            'realisasi' => 'required|integer',
            'link_tugas' => 'required|url',
            'komentar' => 'nullable|string',
        ]);

        // Safely format the date after validation
        $validated['tgl_realisasi'] = \Carbon\Carbon::createFromFormat('m/d/Y', $validated['tgl_realisasi'])->format('Y-m-d');

        $assignment = Assignment::findOrFail($validated['assignment_id']);

        // Check if user is allowed to submit
        if (!Auth::user()->teams->contains($assignment->team_id) && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('unauthorized');
        }

        // Check if the new realisasi exceeds the target
        $currentRealisasiTotal = Submission::where('assignment_id', $assignment->id)->sum('realisasi');
        if (($currentRealisasiTotal + $validated['realisasi']) > $assignment->target) {
            $remainingRealisasi = $assignment->target - $currentRealisasiTotal;
            return redirect()->back()->withErrors(['realisasi' => 'Realisasi tidak boleh melebihi target. Anda hanya dapat menambahkan hingga ' . $remainingRealisasi . '.']);
        }

        // Create the submission
        Submission::create([
            'assignment_id' => $validated['assignment_id'],
            'tgl_realisasi' => $validated['tgl_realisasi'],
            'realisasi' => $validated['realisasi'],
            'link_tugas' => $validated['link_tugas'],
            'komentar' => $validated['komentar'],
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('assignments.index')->with('success', 'Data berhasil disubmit!');
    }

    // public function store(Request $request)
    // {
    //     // Convert date format
    //     $request->merge([
    //         'tgl_realisasi' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->tgl_realisasi)->format('Y-m-d'),
    //     ]);

    //     // Validate the input
    //     $request->validate([
    //         'assignment_id' => 'required|exists:assignments,id',
    //         'tgl_realisasi' => 'required|date',
    //         'realisasi' => 'required|integer|min:0', // Ensure realisasi is non-negative
    //         'link_tugas' => 'required|url',
    //         'komentar' => 'nullable|string',
    //     ]);

    //     // Find the assignment
    //     $assignment = Assignment::findOrFail($request->assignment_id);

    //     // Check if the user is authorized
    //     if (!Auth::user()->teams->contains($assignment->team_id) && Auth::id() !== $assignment->team->leader_id) {
    //         return redirect()->route('unauthorized');
    //     }

    //     // Calculate the current total of realisasi for this assignment
    //     $currentRealisasiTotal = Submission::where('assignment_id', $assignment->id)->sum('realisasi');

    //     // Ensure the new realisasi doesn't exceed the remaining target
    //     if (($currentRealisasiTotal + $request->realisasi) > $assignment->target) {
    //         $remainingRealisasi = $assignment->target - $currentRealisasiTotal;
    //         return redirect()->back()->withErrors(['realisasi' => 'Realisasi tidak boleh melebihi target. Anda hanya dapat menambahkan hingga ' . $remainingRealisasi . '.']);
    //     }

    //     // Create the submission
    //     Submission::create([
    //         'assignment_id' => $request->assignment_id,
    //         'tgl_realisasi' => $request->tgl_realisasi,
    //         'realisasi' => $request->realisasi,
    //         'link_tugas' => $request->link_tugas,
    //         'komentar' => $request->komentar,
    //         'user_id' => Auth::id(),
    //     ]);

    //     return redirect()->route('assignments.index')->with('success', 'Data berhasil disubmit!');
    // }

    public function updateApprovalStatus(Request $request, Submission $submission)
    {
        // Check if the authenticated user is the leader of the team assigned to the submission
        if (Auth::id() !== $submission->assignment->team->leader_id) {
            return redirect()->back()->with('error', 'You are not authorized to change the approval status of this submission.');
        }

        // Validate the request
        $validated = $request->validate([
            'approval_status' => 'required|integer|in:0,1,2', // Assuming 0 = Pending, 1 = Approved, 2 = Rejected
        ]);

        // Update the approval status
        $submission->update(['approval_status' => $validated['approval_status']]);

        return redirect()->back()->with('success', 'Status data berhasil diubah');
    }
}

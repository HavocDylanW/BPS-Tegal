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
        $assignment = Assignment::findOrFail($assignmentId); // Fetch the specific assignment

        // Check if the authenticated user is part of the team associated with the assignment or is the leader
        if (!Auth::user()->teams->contains($assignment->team_id) && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('unauthorized'); // Redirect to unauthorized page
        }

        return view('submission.create', compact('assignment')); // Pass the assignment to the view
    }

    // Edit an existing submission
    public function edit(Submission $submission)
    {
        $assignment = $submission->assignment;

        // Only the employee who submitted or the leader can edit the submission
        if (Auth::id() !== $submission->user_id && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('assignments.index')->with('error', 'You are not authorized to edit this submission.');
        }

        // Return the edit view with the submission
        return view('submission.edit', compact('submission'));
    }

    // Update the submission
    public function update(Request $request, Submission $submission)
    {
        // Validate the request
        $request->validate([
            'link_tugas' => 'required|url',
            'tgl_realisasi' => 'required|date',
            'realisasi' => 'required|integer',
            'komentar' => 'nullable|string', // Add validation for komentar
        ]);

        $assignment = $submission->assignment;

        // Ensure the authenticated user is either the one who made the submission or the leader
        if (Auth::id() !== $submission->user_id && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('assignments.index')->with('error', 'You are not authorized to update this submission.');
        }

        // Update the submission
        $submission->update([
            'link_tugas' => $request->input('link_tugas'),
            'tgl_realisasi' => $request->input('tgl_realisasi'),
            'realisasi' => $request->input('realisasi'),
            'komentar' => $request->input('komentar'), // Update the komentar field
            'tgl_pengumpulan' => now(),
        ]);

        return redirect()->route('assignments.index')->with('success', 'Submission updated successfully.');
    }

    // Store a new submission in SubmissionController
    public function store(Request $request)
    {

        $request->merge([
            'tgl_realisasi' => \Carbon\Carbon::createFromFormat('m/d/Y', $request->tgl_realisasi)->format('Y-m-d')
        ]);    

        // Validate the incoming request data
        $request->validate([
            'assignment_id' => 'required|exists:assignments,id',
            'tgl_realisasi' => 'required|date',
            'realisasi' => 'required|integer',
            'link_tugas' => 'required|url',
            'komentar' => 'nullable|string',
        ]);

        // Fetch the assignment to check its team
        $assignment = Assignment::findOrFail($request->assignment_id);

        // Check if the authenticated user is part of the team associated with the assignment or is the leader
        if (!Auth::user()->teams->contains($assignment->team_id) && Auth::id() !== $assignment->team->leader_id) {
            return redirect()->route('unauthorized'); // Redirect to unauthorized page
        }

        // Create a new submission record with the authenticated user's ID
        Submission::create([
            'assignment_id' => $request->assignment_id,
            'tgl_realisasi' => $request->tgl_realisasi,
            'realisasi' => $request->realisasi,
            'link_tugas' => $request->link_tugas,
            'komentar' => $request->komentar,
            'user_id' => Auth::id(), // Set the user_id to the authenticated user's ID
        ]);

        // Redirect to the assignments index page after successful submission
        return redirect()->route('assignments.index')->with('success', 'Assignment submitted successfully!');
    }
}

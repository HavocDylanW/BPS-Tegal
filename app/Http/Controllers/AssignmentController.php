<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\Team;

class AssignmentController extends Controller
{
    // Show all assignments (filtered for employees)
    public function index()
    {
        $user = Auth::user();

        if ($user->roles->contains('name', 'Employee')) {
            // Employees: Only assignments for their teams
            $assignments = Assignment::whereHas('team', function ($query) use ($user) {
                $query->where(function ($subQuery) use ($user) {
                    $subQuery->whereIn('teams.id', $user->teams->pluck('id')) // Team members
                            ->orWhere('teams.leader_id', $user->id);         // Or if the user is the leader
                });
            })->with('team')->get();

            // Fetch teams only for the current employee
            $teams = $user->teams;
        } else {
            // Admins and Super Admins: All assignments and teams
            $assignments = Assignment::with('team')->get();
            $teams = Team::all(); // Fetch all teams
        }

        return view('assignment.index', compact('assignments', 'teams'));
    }

    public function showSubmissions(Request $request, $assignmentId)
    {
        $assignment = Assignment::with(['submissions.user'])->findOrFail($assignmentId);

        // Check user access permissions (already implemented in your method)
        if (!Auth::user()->teams->contains($assignment->team_id) &&
            Auth::id() !== $assignment->team->leader_id &&
            !Auth::user()->roles->contains('name', 'Admin') &&
            !Auth::user()->roles->contains('name', 'Super Admin')) {
            return redirect()->route('unauthorized');
        }

        // Get the filter from the request
        $filter = $request->get('filter');
        $submissions = $assignment->submissions();

        // Apply filtering based on approval_status
        if (in_array($filter, ['0', '1', '2'])) {
            $submissions->where('approval_status', $filter);
        }

        // Pass filtered submissions to the view
        $submissions = $submissions->get();

        return view('assignment.submissions', compact('assignment', 'submissions', 'filter'));
    }

    public function create()
    {
        $teams = Team::all(); // Get all teams
        return view('assignment.create', compact('teams')); // Pass teams to the view
    }

    // Store a new assignment

    public function store(Request $request)
    {
        $user = Auth::user();

        // Check if the user is an Admin
        if (!$user->roles->contains('name', 'Admin')) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak berwenang untuk membuat tugas.');
        }

        $request->validate([
            'judul' => 'required',
            'target' => 'required',
            'satuan' => 'required',
            'tgl_mulai' => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
            'keterangan' => 'required',
            'team_id' => 'required|exists:teams,id',
        ]);

        // Create a new assignment and assign the creator's ID
        $assignment = Assignment::create([
            'judul' => $request->input('judul'),
            'target' => $request->input('target'),
            'satuan' => $request->input('satuan'),
            'tgl_mulai' => $request->input('tgl_mulai'),
            'tgl_selesai' => $request->input('tgl_selesai'),
            'keterangan' => $request->input('keterangan'),
            'team_id' => $request->input('team_id'),
            'created_by' => Auth::id(), // Set the currently authenticated user as the creator
        ]);

        return redirect()->route('assignments.index')->with('success', 'Tugas berhasil dibuat!');
    }

    public function editKeterangan(Assignment $assignment)
    {
        $user = Auth::user();

        // Restrict access to the leader of the assignment's team
        if ($assignment->team->leader_id !== $user->id) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak berwenang untuk mengubah keterangan ini.');
        }

        return view('assignment.edit', compact('assignment'));
    }

    public function updateKeterangan(Request $request, Assignment $assignment)
    {
        $user = Auth::user();

        // Restrict access to the leader of the assignment's team
        if ($assignment->team->leader_id !== $user->id) {
            return redirect()->route('assignments.index')->with('error', 'Anda tidak berwenang untuk mengubah tugas ini.');
        }

        // Validate the request data
        $request->validate([
            'keterangan' => 'required|string|max:255', // Adjust validation as needed
        ]);

        // Update the `keterangan` field
        $assignment->keterangan = $request->keterangan;
        $assignment->save();

        // Redirect or respond as needed
        return redirect()->route('assignments.index')->with('success', 'Keterangan berhasil diubah!');
    }
}
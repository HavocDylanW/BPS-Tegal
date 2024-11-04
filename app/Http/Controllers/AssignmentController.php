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
        $teams = Team::all(); // Fetch all teams

        // If the user is an employee, only show assignments for their teams
        if ($user->roles->contains('name', 'Employee')) {
            $assignments = Assignment::whereHas('team', function ($query) use ($user) {
                $query->where(function ($subQuery) use ($user) {
                    $subQuery->whereIn('teams.id', $user->teams->pluck('id')) // Team members
                             ->orWhere('teams.leader_id', $user->id);         // Or if the user is the leader
                });
            })->with('team')->get();
        } else {
            // For Admins or Super Admins, show all assignments
            $assignments = Assignment::with('team')->get();
        }                

        // if ($user->roles->contains('name', 'Employee')) {
        //     $assignments = Assignment::whereHas('team', function($query) use ($user) {
        //         $query->whereIn('teams.id', $user->teams->pluck('id'));
        //     })->with('team')->get();
        // } else {
        //     // For Admins or Super Admins, show all assignments
        //     $assignments = Assignment::with('team')->get();
        // }

        return view('assignment.index', compact('assignments', 'teams')); // Pass teams to the view
    }

    public function showSubmissions($assignmentId)
    {
        $assignment = Assignment::with('submissions.user')->findOrFail($assignmentId); // Fetch the assignment with its submissions

        // Check if the authenticated user is either part of the team, the leader, or has the role of Admin/Super Admin
        if (!Auth::user()->teams->contains($assignment->team_id) && 
            Auth::id() !== $assignment->team->leader_id && // Check if the user is the leader
            !Auth::user()->roles->contains('name', 'Admin') && 
            !Auth::user()->roles->contains('name', 'Super Admin')) {
            return redirect()->route('unauthorized'); // Redirect to unauthorized page
        }

        // If the user is part of the team, the leader, or is an Admin/Super Admin, allow access
        return view('assignment.submissions', compact('assignment'));
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
            return redirect()->route('assignments.index')->with('error', 'You do not have permission to create an assignment.');
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

        return redirect()->route('assignments.index')->with('success', 'Assignment created successfully.');
    }

    public function editKeterangan(Assignment $assignment)
    {
        return view('assignment.edit', compact('assignment'));
    }

    public function updateKeterangan(Request $request, Assignment $assignment)
    {
        // Validate the request data
        $request->validate([
            'keterangan' => 'required|string|max:255', // Adjust validation as needed
        ]);

        // Update the keterangan field
        $assignment->keterangan = $request->keterangan;
        $assignment->save();

        // Redirect or respond as needed
        return redirect()->route('assignments.index')->with('success', 'Keterangan updated successfully.');
    }
}
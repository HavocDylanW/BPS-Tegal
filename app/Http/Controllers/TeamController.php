<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Only allow superadmins to access these routes
    public function __construct()
    {
        $this->middleware('checkRole:Super Admin')->except(['index']);
    }

    // List all teams
    public function index()
    {
        $user = Auth::user(); // Get the authenticated user
        $teams = Team::with('members')->get(); // Fetch teams with their members
        return view('team.index', compact('teams', 'user')); // Pass both variables to the view
    }

    // Show form for creating a team
    
    public function create()
    {
        // Fetch all users who are admins (for the leader dropdown)
        $leaders = User::whereHas('roles', function ($query) {
            $query->where('name', 'admin');
        })->get();

        // Fetch all users who can be team members (admins and employees)
        $employees = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['employee', 'admin']);
        })->get();

        // Get IDs of members in any team
        $teamMembers = Team::with('members') // Eager load members
            ->get()
            ->pluck('members.*.id') // Get all member IDs
            ->flatten() // Flatten the array
            ->unique(); // Ensure unique IDs

        // Filter employees to exclude those already in any team
        $availableEmployees = $employees->whereNotIn('id', $teamMembers);

        // Get IDs of leaders already assigned to a team
        $assignedLeaders = Team::pluck('leader_id')->toArray();

        // Filter leaders to exclude those already assigned to a team
        $availableLeaders = $leaders->whereNotIn('id', $assignedLeaders);

        // Pass the available leaders and available employees to the view
        return view('team.create', compact('availableLeaders', 'availableEmployees'));
    }

    public function edit($id)
    {
        // Fetch the team along with its members and leader
        $team = Team::with('members', 'leader')->findOrFail($id);

        // Fetch all users who can be leaders
        $leaders = User::whereHas('roles', function ($query) {
            $query->where('name', 'leader');
        })->get();

        // Fetch all users who can be team members
        $employees = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['employee', 'admin']);
        })->get();

        // Get the IDs of the current team members
        $lastTeamMembers = $team->members->pluck('id')->toArray();

        // Get IDs of members in other teams
        $otherTeamMembers = Team::where('id', '!=', $id) // Exclude the current team
            ->with('members') // Eager load members
            ->get()
            ->pluck('members.*.id') // Get all member IDs
            ->flatten() // Flatten the array
            ->unique(); // Ensure unique IDs

        // Filter employees to exclude those already in other teams
        $availableEmployees = $employees->whereNotIn('id', $otherTeamMembers);

        // Pass the team, leaders, available employees, and last team members to the view
        return view('team.edit', compact('team', 'leaders', 'availableEmployees', 'lastTeamMembers'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:teams,name',
            'leader' => 'required|exists:users,id', // Validate that the selected leader exists
            'members' => 'required|array',
        ]);

        // Check for existing members
        $existingMembers = User::whereIn('id', $request->members)
            ->whereHas('teams')
            ->pluck('name')
            ->toArray();

        if (count($existingMembers) > 0) {
            return back()->withErrors(['members' => 'The following employees are already part of another team: ' . implode(', ', $existingMembers)]);
        }

        // Create the team and associate the leader
        $team = Team::create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'leader_id' => $request->leader, // Set the selected leader here
        ]);

        // Attach the valid members to the team
        $team->members()->attach($request->members);

        // dd($leaders, $employees, $lastTeam, $lastTeamMembers);

        return redirect()->route('teams.index')->with('success', 'Tim berhasil dibuat!');
    }

    // Update team
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:teams,name,' . $id,
            'leader' => 'required|exists:users,id',
            'members' => 'required|array',
        ]);

        $team = Team::findOrFail($id);
        $team->update([
            'name' => $request->name,
            'leader_id' => $request->leader, // Update leader
        ]);

        // Sync team members
        $team->members()->sync($request->members);

        return redirect()->route('teams.index')->with('success', 'Tim berhasil diubah!');
    }

    // Delete team
    public function destroy($id)
    {
        $team = Team::findOrFail($id);

        if ($team->assignments()->exists()) {
            return redirect()->back()->with('error', 'Tidak dapat menghapus tim yang sudah terdapat tugas..');
        }

        $team->delete();

        return redirect()->route('teams.index')->with('success', 'Tim berhasil dihapus!');
    }
}

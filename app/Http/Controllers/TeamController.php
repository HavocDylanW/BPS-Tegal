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
        $teams = Team::with('members')->get();
        return view('team.index', compact('teams'));
    }

    // Show form for creating a team
    public function create()
    {
        // Fetch users with the role of 'admin' for team leaders
        $leaders = User::whereHas('roles', function($query) {
            $query->where('name', 'Admin'); // Only include admins as leaders
        })->get();

        // Fetch users with roles of 'employee' for team members
        $employees = User::whereHas('roles', function($query) {
            $query->where('name', 'Employee'); // Include only employees
        })->get();

        // Fetch the last team and its members
        $lastTeam = Team::latest()->first();
        $lastTeamMembers = $lastTeam ? $lastTeam->members()->pluck('id')->toArray() : [];

        // dd($leaders, $employees, $lastTeam, $lastTeamMembers);

        return view('team.create', compact('leaders', 'employees', 'lastTeamMembers')); // Pass leaders, employees, and lastTeamMembers to the view
    }

    public function edit($id)
    {
        $team = Team::with('members', 'leader')->findOrFail($id);
        $users = User::whereHas('roles', function ($query) {
            $query->whereIn('name', ['employee', 'admin']);
        })->get();

        return view('team.edit', compact('team', 'users')); // Pass leader and users to view
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

        return redirect()->route('teams.index')->with('success', 'Team created successfully!');
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

        return redirect()->route('teams.index')->with('success', 'Team updated successfully!');
    }

    // Delete team
    public function destroy($id)
    {
        $team = Team::findOrFail($id);
        $team->delete();
        return redirect()->route('teams.index')->with('success', 'Team deleted successfully!');
    }
}

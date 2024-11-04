<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;

class TeamMemberController extends Controller
{
    // Add a member to a team
    public function store(Request $request, $teamId)
    {
        $team = Team::findOrFail($teamId);
        $team->members()->attach($request->employee_id);

        return back()->with('success', 'Employee added to the team.');
    }

    // Remove a member from a team
    public function destroy($teamId, $employeeId)
    {
        $team = Team::findOrFail($teamId);
        $team->members()->detach($employeeId);

        return back()->with('success', 'Employee removed from the team.');
    }
}

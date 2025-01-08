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
        $validatedData = $request->validate([
            'employee_id' => 'required|exists:users,id',
        ]);

        $team = Team::findOrFail($teamId);
        $employee = User::findOrFail($request->employee_id);

        // Check if the user is an Admin or Employee
        if (!$employee->roles->contains('name', ['Admin', 'Employee'])) {
            return back()->withErrors(['employee_id' => 'Hanya Admin atau Employee yang bisa ditambahkan kedalam tim.']);
        }

        // Check if the employee is already a member of this team
        if ($team->members->contains($employee->id)) {
            return back()->withErrors(['employee_id' => 'Employee yang dipilih sudah termasuk kedalam tim.']);
        }

        $team->members()->attach($employee->id);

        return back()->with('success', 'Employee berhasil ditambahkan kedalam tim.');
    }

    // Remove a member from a team
    public function destroy($teamId, $employeeId)
    {
        $team = Team::findOrFail($teamId);

        // Check if the user is actually a member of the team
        if (!$team->members->contains($employeeId)) {
            return back()->withErrors(['employee_id' => 'Employee ini tidak termasuk kedalam tim.']);
        }

        $team->members()->detach($employeeId);

        return back()->with('success', 'Employee dikeluarkan dari tim.');
    }
}

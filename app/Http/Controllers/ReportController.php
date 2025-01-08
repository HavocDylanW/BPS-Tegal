<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Assignment;
use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\AssignmentExport; // Import the AssignmentExport class

class ReportController extends Controller
{
    /**
     * Display a listing of the resource with pagination.
     */
    public function index(Request $request)
    {
        $user = Auth::user();
        $teams = Team::all();

        // Paginate assignments with optional team filter
        $query = Assignment::with('team');
        if ($request->has('team_id')) {
            $query->where('team_id', $request->team_id);
        }
        $assignments = $query->paginate(10); // 10 assignments per page

        return view('report.index', compact('assignments', 'teams'));
    }

    /**
     * Export assignments to Excel.
     */
    public function export()
    {
        $user = Auth::user();

        // Check if the user has permission to export
        if (!$user->roles->contains(function ($role) {
            return in_array($role->name, ['Admin', 'Super Admin']);
        })) {
            abort(403, 'Unauthorized action.');
        }

        return Excel::download(new AssignmentExport, 'assignments.xlsx');
    }
}

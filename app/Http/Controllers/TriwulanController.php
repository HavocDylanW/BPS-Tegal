<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\Submission;
use App\Models\User;
use App\Models\Team;

class TriwulanController extends Controller
{
    public function index(Request $request)
    {
        $teams = Team::all();
        $teamNames = [];
        $totalTargets = [];
        $totalRealisasi = [];
        
        $quarter = $request->input('quarter', 1);
        $year = $request->input('year', date('Y'));

        $years = Assignment::select(DB::raw('YEAR(created_at) as year'))
            ->distinct()
            ->orderBy('year', 'asc')
            ->pluck('year');

        $startDates = [1 => "01-01", 2 => "04-01", 3 => "07-01", 4 => "10-01"];
        $endDates = [1 => "03-31", 2 => "06-30", 3 => "09-30", 4 => "12-31"];

        // Loop to collect chart data
        foreach ($teams as $team) {
            $teamNames[] = $team->name;
        
            $assignments = Assignment::where('team_id', $team->id)
                ->whereBetween('created_at', [
                    date("Y-{$startDates[$quarter]}", strtotime("$year-01-01")),
                    date("Y-{$endDates[$quarter]}", strtotime("$year-12-31"))
                ])
                ->get();
        
            $targets = $assignments->pluck('target')->toArray();
            $totalTargets[] = array_sum($targets);
        
            $realisasi = 0;
            foreach ($assignments as $assignment) {
                $submissions = Submission::where('assignment_id', $assignment->id)
                    ->where('approval_status', 1) // Correctly check for "Approved" submissions
                    ->get();
        
                $realisasi += $submissions->sum('realisasi');
            }
            $totalRealisasi[] = $realisasi;
        }        

        // Separate query for userAssignmentCount
        $user = $request->user();

        $userAssignmentCount = Assignment::whereHas('team', function ($query) use ($user) {
            $query->where('leader_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                });
        })
        ->count();

        $userSubmissionCount = Submission::whereHas('assignment.team', function ($query) use ($user) {
                $query->where('leader_id', $user->id)
                    ->orWhereHas('users', function ($query) use ($user) {
                        $query->where('id', $user->id);
                });
        })
        ->count();

        $userTeamName = Team::where(function ($query) use ($user) {
            $query->where('leader_id', $user->id)
                ->orWhereHas('users', function ($query) use ($user) {
                    $query->where('id', $user->id);
                });
        })
        ->first(['name']); // Retrieves the first matching team name

        return view('index', compact('teamNames', 'totalTargets', 'totalRealisasi', 'userSubmissionCount', 'userAssignmentCount', 'userTeamName', 'quarter', 'year', 'years'));
    }
}
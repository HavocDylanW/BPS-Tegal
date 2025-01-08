<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TriwulanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('login');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'auth']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/user/profile', [UserController::class, 'profile'])->name('profile');
    Route::patch('/user/profile', [UserController::class, 'profileUpdate'])->name('profile.update');

    // Dashboard routes
    Route::get('/dashboard', [TriwulanController::class, 'index'])->middleware('checkRole:Employee,Admin,Super Admin')->name('dashboard');

    // Assignment routes
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'showSubmissions'])->name('assignments.submissions');

    // Report routes
    Route::get('/reports', [ReportController::class,'index'])->name('report.index');
    Route::get('/reports/export', [ReportController::class, 'export'])->name('report.export');

    Route::middleware('checkRole:Admin,Super Admin')->group(function () {
        Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
        Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
        Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'editKeterangan'])->name('assignments.edit');
        Route::patch('/assignments/{assignment}', [AssignmentController::class, 'updateKeterangan'])->name('assignments.update');
    });

    // Submission routes
    Route::get('/submissions/create/{assignment}', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'edit'])->name('submissions.edit');
    Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');

    Route::middleware('checkRole:Admin')->group(function () {
        Route::put('/submissions/{submission}/update-approval-status', [SubmissionController::class, 'updateApprovalStatus'])->name('submission.updateApprovalStatus');
    });

    // Team routes
    Route::middleware('checkRole:Super Admin')->group(function () {
        Route::resource('/users', UserController::class);
        Route::resource('/teams', TeamController::class);
        Route::post('/teams/{team}/members', [TeamMemberController::class, 'store'])->name('teams.members.store');
        Route::delete('/teams/{team}/members/{employee}', [TeamMemberController::class, 'destroy'])->name('teams.members.destroy');
    });
});

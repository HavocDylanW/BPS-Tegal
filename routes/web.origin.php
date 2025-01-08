<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TriwulanController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/employee-dashboard/profile/edit', function () {
    return view('profile.edit');
});

Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile')->middleware('auth');

Route::get('/as', function () {
    return view('assignment.index');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'auth']);

Route::get('/unauthorized', function () {
    return view('errors.unauthorized');
})->name('unauthorized');

// Dashboard route for all roles
Route::get('/e/dashboard', [TriwulanController::class, 'index'])->middleware(['auth', 'checkRole:Employee'])->name('employee.dashboard');
Route::get('/a/dashboard', [TriwulanController::class, 'index'])->middleware(['auth', 'checkRole:Admin'])->name('admin.dashboard');
Route::get('/sa/dashboard', [TriwulanController::class, 'index'])->middleware(['auth', 'checkRole:Super Admin'])->name('superAdmin.dashboard');

Route::group(['middleware' => 'checkRole:Employee'], function () {
    // Submission routes
    // Route::get('/submissions/create/{assignment}', [SubmissionController::class, 'create'])->name('submissions.create');
    // Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
    // Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'edit'])->name('submissions.edit');
    // Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
});

Route::group(['middleware' => 'checkRole:Admin'], function () {
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::get('/assignments/create', [AssignmentController::class, 'create'])->name('assignments.create');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'editKeterangan'])->name('assignments.edit');
    Route::patch('/assignments/{assignment}/edit', [AssignmentController::class, 'updateKeterangan'])->name('assignments.update');
    Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'showSubmissions'])->name('assignments.submissions');
});

Route::group(['middleware' => 'checkRole:Super Admin'], function () {
    Route::resource('/users', UserController::class);
    Route::resource('/teams', TeamController::class);
    Route::post('teams/{team}/members', [TeamMemberController::class, 'store'])->name('teams.members.store');
    Route::delete('teams/{team}/members/{employee}', [TeamMemberController::class, 'destroy'])->name('teams.members.destroy');
});

Route::group(['middleware' => 'checkRole:Employee,Admin,Super Admin'], function () {
    Route::get('/assignments', [AssignmentController::class, 'index'])->name('assignments.index');
    Route::post('/assignments', [AssignmentController::class, 'store'])->name('assignments.store');
    Route::get('/assignments/{assignment}/edit', [AssignmentController::class, 'editKeterangan'])->name('assignments.edit');
    Route::patch('/assignments/{assignment}/edit', [AssignmentController::class, 'updateKeterangan'])->name('assignments.update');
    Route::get('/assignments/{assignment}/submissions', [AssignmentController::class, 'showSubmissions'])->name('assignments.submissions');
});

Route::group(['middleware' => 'checkRole:Employee,Admin,Super Admin'], function () {
// Submission routes
    Route::get('/submissions/create/{assignment}', [SubmissionController::class, 'create'])->name('submissions.create');
    Route::post('/submissions', [SubmissionController::class, 'store'])->name('submissions.store');
    Route::get('/submissions/{submission}/edit', [SubmissionController::class, 'edit'])->name('submissions.edit');
    Route::put('/submissions/{submission}', [SubmissionController::class, 'update'])->name('submissions.update');
});
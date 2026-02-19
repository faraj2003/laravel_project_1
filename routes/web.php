<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\EpisodeController as AdminEpisodeController;

/* --------------------------------------------------------------------------
   PUBLIC & STUDENT ROUTES
   --------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

// Dashboard points to CourseController@dashboard
Route::get('/dashboard', [CourseController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Student Resources
    Route::resource('episodes', EpisodeController::class)->only(['index', 'show']);
    Route::resource('courses', CourseController::class)->only(['index', 'show']);

    // Enrollment Route
    Route::post('/courses/{course}/enroll', [CourseController::class, 'enroll'])->name('courses.enroll');

    // NEW: Episode Completion Route
    Route::post('/episodes/{episode}/complete', [EpisodeController::class, 'complete'])
        ->name('episodes.complete');

    // Complaints & Suggestions (Student Side)
    Route::resource('complaints', ComplaintController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php'; 

/* --------------------------------------------------------------------------
   ADMIN ROUTES
   --------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin') 
    ->group(function () {
        
        Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');

        // FIXED: Now loads the admin-specific dashboard view
        Route::get('/dashboard', function () {
            return view('admin.dashboard'); 
        })->name('dashboard');

        Route::resource('courses', AdminCourseController::class);
        Route::patch('courses/{course}/toggle', [AdminCourseController::class, 'togglePublish'])
            ->name('courses.toggle-publish');
        Route::post('courses/{course}/enroll', [AdminCourseController::class, 'enrollStudent'])->name('courses.enroll');
        Route::delete('courses/{course}/remove-student', [AdminCourseController::class, 'removeStudent'])->name('courses.remove-student');

        Route::resource('courses.episodes', AdminEpisodeController::class);

        Route::get('complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::patch('complaints/{complaint}/resolve', [AdminComplaintController::class, 'markResolved'])->name('complaints.resolve');
    });
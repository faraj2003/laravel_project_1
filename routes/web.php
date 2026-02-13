<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ComplaintController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\ComplaintController as AdminComplaintController;
use App\Http\Controllers\Admin\EpisodeController as AdminEpisodeController; // <--- Import Admin Episode Controller

/* --------------------------------------------------------------------------
   PUBLIC & STUDENT ROUTES
   --------------------------------------------------------------------------
*/
Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [CourseController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Student Resources
    Route::resource('episodes', EpisodeController::class);
    Route::resource('courses', CourseController::class)->only(['index', 'show']);

    // Complaints & Suggestions (Student Side)
    Route::resource('complaints', ComplaintController::class)->only(['index', 'create', 'store']);
});

require __DIR__.'/auth.php'; // Standard student auth routes

/* --------------------------------------------------------------------------
   ADMIN ROUTES
   --------------------------------------------------------------------------
*/

// Admin Login Routes (Guest only for admins)
Route::prefix('admin')->middleware('guest:admin')->group(function () {
    Route::get('login', [AdminLoginController::class, 'create'])->name('admin.login');
    Route::post('login', [AdminLoginController::class, 'store']);
});

// Admin Protected Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware('auth:admin') // Protects using the 'admins' table
    ->group(function () {
        
        Route::post('logout', [AdminLoginController::class, 'destroy'])->name('logout');

        // Admin Dashboard
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        // Course Management
        Route::resource('courses', AdminCourseController::class);
        Route::patch('courses/{course}/toggle', [AdminCourseController::class, 'togglePublish'])
            ->name('courses.toggle');

        // Episode Management (Nested under courses) <--- Added for adding episodes to courses
        Route::resource('courses.episodes', AdminEpisodeController::class);

        // Complaints Management (Admin Side)
        Route::get('complaints', [AdminComplaintController::class, 'index'])->name('complaints.index');
        Route::patch('complaints/{complaint}/resolve', [AdminComplaintController::class, 'markResolved'])->name('complaints.resolve');
    });
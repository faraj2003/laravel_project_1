<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


// Episodes (normal users)
Route::middleware(['auth'])->group(function () {
    Route::resource('episodes', EpisodeController::class);
});


// Courses (normal viewing)
Route::middleware(['auth'])->group(function () {
    Route::resource('courses', CourseController::class)->only(['index', 'show']);
});

Route::get('/', [CourseController::class, 'index']);



// Admin Panel
Route::middleware(['auth','admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::resource('courses', AdminCourseController::class);

        Route::patch(
            'courses/{course}/toggle',
            [AdminCourseController::class, 'togglePublish']
        )->name('courses.toggle');
    });
require __DIR__.'/auth.php';

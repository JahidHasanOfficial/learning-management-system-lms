<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CourseController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Course Management
    Route::get('course', [CourseController::class, 'index'])->name('course.index')->middleware('permission:course.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create')->middleware('permission:course.create');
    Route::post('course', [CourseController::class, 'store'])->name('course.store')->middleware('permission:course.store');
    Route::get('course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit')->middleware('permission:course.edit');
    Route::put('course/{course}', [CourseController::class, 'update'])->name('course.update')->middleware('permission:course.update');
    Route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.destroy')->middleware('permission:course.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('permission:profile.destroy');
});

require __DIR__.'/auth.php';

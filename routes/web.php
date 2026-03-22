<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;

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

    // Role Management
    Route::get('role', [RoleController::class, 'index'])->name('role.index')->middleware('permission:role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('role.create')->middleware('permission:role.create');
    Route::post('role', [RoleController::class, 'store'])->name('role.store')->middleware('permission:role.store');
    Route::get('role/{role}/edit', [RoleController::class, 'edit'])->name('role.edit')->middleware('permission:role.edit');
    Route::put('role/{role}', [RoleController::class, 'update'])->name('role.update')->middleware('permission:role.update');
    Route::delete('role/{role}', [RoleController::class, 'destroy'])->name('role.destroy')->middleware('permission:role.destroy');

    // User Management
    Route::get('user', [UserController::class, 'index'])->name('user.index')->middleware('permission:user.index');
    Route::get('user/create', [UserController::class, 'create'])->name('user.create')->middleware('permission:user.create');
    Route::post('user', [UserController::class, 'store'])->name('user.store')->middleware('permission:user.store');
    Route::get('user/{user}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('permission:user.edit');
    Route::get('user/{user}', [UserController::class, 'show'])->name('user.show')->middleware('permission:user.show');
    Route::put('user/{user}', [UserController::class, 'update'])->name('user.update')->middleware('permission:user.update');
    Route::post('user/{user}/status', [UserController::class, 'status'])->name('user.status')->middleware('permission:user.update');
    Route::delete('user/{user}', [UserController::class, 'destroy'])->name('user.destroy')->middleware('permission:user.destroy');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

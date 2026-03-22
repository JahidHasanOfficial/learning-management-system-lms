<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CourseController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\CurriculumController;
use App\Http\Controllers\Backend\LiveClassController;
use App\Http\Controllers\Backend\InstructorController;
use App\Http\Controllers\Student\LearningController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Course Management
    Route::get('course', [CourseController::class, 'index'])->name('course.index')->middleware('permission:course.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create')->middleware('permission:course.create');
    Route::post('course', [CourseController::class, 'store'])->name('course.store')->middleware('permission:course.store');
    Route::get('course/{course}', [CourseController::class, 'show'])->name('course.show')->middleware('permission:course.index');
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

    // Instructor Management
    Route::get('instructors', [InstructorController::class, 'index'])->name('instructor.index')->middleware('permission:user.index');
    Route::get('instructors/{user}', [InstructorController::class, 'show'])->name('instructor.show')->middleware('permission:user.index');

    // Course Curriculum Management
    Route::get('course/{course}/curriculum', [CurriculumController::class, 'index'])->name('course.curriculum')->middleware('permission:curriculum.manage');
    Route::post('course/{course}/section', [CurriculumController::class, 'storeSection'])->name('course.section.store')->middleware('permission:curriculum.manage');
    Route::post('section/{section}/lesson', [CurriculumController::class, 'storeLesson'])->name('course.lesson.store')->middleware('permission:curriculum.manage');
    Route::post('curriculum/reorder', [CurriculumController::class, 'reorder'])->name('course.curriculum.reorder')->middleware('permission:curriculum.manage');
   
    // Live Class Module
    Route::get('live-class', [LiveClassController::class, 'index'])->name('live-class.index')->middleware('permission:live_class.index');
    Route::get('live-class/create', [LiveClassController::class, 'create'])->name('live-class.create')->middleware('permission:live_class.create');
    Route::post('live-class', [LiveClassController::class, 'store'])->name('live-class.store')->middleware('permission:live_class.store');
    Route::get('live-class/{liveClass}/edit', [LiveClassController::class, 'edit'])->name('live-class.edit')->middleware('permission:live_class.edit');
    Route::put('live-class/{liveClass}', [LiveClassController::class, 'update'])->name('live-class.update')->middleware('permission:live_class.update');
    Route::delete('live-class/{liveClass}', [LiveClassController::class, 'destroy'])->name('live-class.destroy')->middleware('permission:live_class.destroy');
    Route::get('api/course/{course}/batches', [LiveClassController::class, 'getBatches'])->middleware('permission:live_class.index');

    // Category Management
    Route::get('category', [CategoryController::class, 'index'])->name('category.index')->middleware('permission:course.category');
    Route::get('category/create', [CategoryController::class, 'create'])->name('category.create')->middleware('permission:course.category');
    Route::post('category', [CategoryController::class, 'store'])->name('category.store')->middleware('permission:course.category');
    Route::get('category/{category}/edit', [CategoryController::class, 'edit'])->name('category.edit')->middleware('permission:course.category');
    Route::put('category/{category}', [CategoryController::class, 'update'])->name('category.update')->middleware('permission:course.category');
    Route::delete('category/{category}', [CategoryController::class, 'destroy'])->name('category.destroy')->middleware('permission:course.category');

    // Student Learning Module
    Route::get('my-courses', [LearningController::class, 'myCourses'])->name('student.my-courses')->middleware('permission:student.my-courses');
    Route::get('learning/{course}/{lesson?}', [LearningController::class, 'player'])->name('student.player')->middleware('permission:student.player');
    Route::post('lesson/{lesson}/complete', [LearningController::class, 'completeLesson'])->middleware('permission:student.player');
    Route::post('lesson/{lesson}/bookmark', [LearningController::class, 'saveBookmark'])->middleware('permission:student.player');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit')->middleware('permission:profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update')->middleware('permission:profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy')->middleware('permission:profile.destroy');
});

require __DIR__.'/auth.php';

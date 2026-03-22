<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Course\StoreCourseRequest;
use App\Http\Requests\Backend\Course\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

use App\Models\Category;

class CourseController extends Controller
{
    protected $courseService;

    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }

    /**
     * Display a listing of the courses.
     */
    public function index(Request $request)
    {
        $filters = $request->only(['status', 'category_id', 'search']);
        if (auth()->user()->hasRole('Instructor')) {
            $filters['instructor_id'] = auth()->id();
        }

        $courses = $this->courseService->getAllCourses($filters);
        return view('backend.pages.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $categories = Category::all();
        $instructors = \App\Models\User::role('Instructor')->get();
        return view('backend.pages.courses.create', compact('categories', 'instructors'));
    }

    /**
     * Display the specified course details.
     */
    public function show(Course $course)
    {
        $course->load(['category', 'instructor', 'sections.lessons', 'batches', 'reviews.user']);
        return view('backend.pages.courses.show', compact('course'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $this->courseService->storeCourse($request->validated());

        return redirect()->route('course.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        $categories = Category::all();
        $instructors = \App\Models\User::role('Instructor')->get();
        return view('backend.pages.courses.edit', compact('course', 'categories', 'instructors'));
    }

    /**
     * Update the specified course in storage.
     */
    public function update(UpdateCourseRequest $request, Course $course)
    {
        $data = $request->validated();

        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = \App\Helpers\ImageHelper::update($request->file('thumbnail'), 'courses', $course->thumbnail);
        }

        $this->courseService->updateCourse($course, $data);

        return redirect()->route('course.index')
            ->with('success', 'Course updated successfully.');
    }

    /**
     * Remove the specified course from storage.
     */
    public function destroy(Course $course)
    {
        // Delete image before deleting course record
        \App\Helpers\ImageHelper::delete($course->thumbnail);
        
        $this->courseService->deleteCourse($course);

        return redirect()->route('course.index')
            ->with('success', 'Course deleted successfully.');
    }
}

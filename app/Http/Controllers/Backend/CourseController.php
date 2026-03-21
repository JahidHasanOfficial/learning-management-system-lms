<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Backend\Course\StoreCourseRequest;
use App\Http\Requests\Backend\Course\UpdateCourseRequest;
use App\Models\Course;
use App\Services\CourseService;
use Illuminate\Http\Request;

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
    public function index()
    {
        $courses = $this->courseService->getAllCourses();
        return view('backend.pages.courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        return view('backend.pages.courses.create');
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = \App\Helpers\ImageHelper::create($request->file('thumbnail'), 'courses');
        }

        $this->courseService->storeCourse($data);

        return redirect()->route('course.index')
            ->with('success', 'Course created successfully.');
    }

    /**
     * Show the form for editing the specified course.
     */
    public function edit(Course $course)
    {
        return view('backend.pages.courses.edit', compact('course'));
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

<?php

namespace App\Services;

use App\Models\Course;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CourseService
{
    /**
     * Get all courses with optional filtering.
     */
    public function getAllCourses()
    {
        return Course::with('instructor')
            ->latest()
            ->paginate(10);
    }

    /**
     * Store a new course.
     */
    public function storeCourse(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $data['instructor_id'] = Auth::id();
        
        return Course::create($data);
    }

    /**
     * Update an existing course.
     */
    public function updateCourse(Course $course, array $data)
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }
        
        $course->update($data);
        return $course;
    }

    /**
     * Delete a course.
     */
    public function deleteCourse(Course $course)
    {
        return $course->delete();
    }
}

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
    public function getAllCourses(array $filters = [])
    {
        $query = Course::with(['instructor', 'category']);

        if (isset($filters['status'])) {
            $query->where('status', $filters['status']);
        }

        if (isset($filters['category_id'])) {
            $query->where('category_id', $filters['category_id']);
        }

        if (isset($filters['instructor_id'])) {
            $query->where('instructor_id', $filters['instructor_id']);
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Store a new course.
     */
    public function storeCourse(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        $data['instructor_id'] = Auth::id() ?? $data['instructor_id'];

        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            $data['thumbnail'] = \App\Helpers\ImageHelper::create($data['thumbnail'], 'courses');
        }
        
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

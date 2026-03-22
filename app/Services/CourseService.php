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

        if (isset($filters['search'])) {
            $query->where('title', 'LIKE', '%' . $filters['search'] . '%');
        }

        return $query->latest()->paginate(10);
    }

    /**
     * Store a new course.
     */
    public function storeCourse(array $data)
    {
        $data['slug'] = Str::slug($data['title']);
        if (isset($data['thumbnail']) && $data['thumbnail'] instanceof \Illuminate\Http\UploadedFile) {
            $data['thumbnail'] = \App\Helpers\ImageHelper::create($data['thumbnail'], 'courses');
        }

        $instructor_ids = $data['instructor_ids'] ?? [];
        unset($data['instructor_ids']);

        $data['instructor_id'] = $instructor_ids[0] ?? Auth::id();

        $course = Course::create($data);
        
        if (!empty($instructor_ids)) {
            $course->instructors()->sync($instructor_ids);
        }

        return $course;
    }

    /**
     * Update an existing course.
     */
    public function updateCourse(Course $course, array $data)
    {
        if (isset($data['title'])) {
            $data['slug'] = Str::slug($data['title']);
        }

        $instructor_ids = $data['instructor_ids'] ?? [];
        unset($data['instructor_ids']);

        if (!empty($instructor_ids)) {
            $data['instructor_id'] = $instructor_ids[0];
            $course->instructors()->sync($instructor_ids);
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

<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display the landing page.
     */
    public function index()
    {
        $featuredCourses = Course::with(['category', 'instructor'])
            ->where('status', 'published')
            ->where('is_featured', true)
            ->latest()
            ->take(6)
            ->get();

        $categories = Category::withCount('courses')
            ->latest()
            ->take(8)
            ->get();

        $topInstructors = User::role('Instructor')
            ->latest()
            ->take(4)
            ->get();

        return view('frontend.pages.home', compact('featuredCourses', 'categories', 'topInstructors'));
    }

    /**
     * Display course details.
     */
    public function courseDetails($slug)
    {
        $course = Course::with(['category', 'instructor', 'sections.lessons'])
            ->where('slug', $slug)
            ->firstOrFail();

        return view('frontend.pages.course-details', compact('course'));
    }

    /**
     * Enroll in a course.
     */
    public function enroll(Course $course)
    {
        $user = auth()->user();

        // Check if already enrolled
        if ($user->enrolledCourses()->where('course_id', $course->id)->exists()) {
            return redirect()->route('student.my-courses')
                ->with('info', 'You are already enrolled in this course.');
        }

        // Simple enrollment
        $user->enrolledCourses()->attach($course->id, [
            'enrolled_at' => now(),
            'status' => 'enrolled'
        ]);

        return redirect()->route('student.my-courses')
            ->with('success', 'Enrolled successfully! Enjoy your learning.');
    }
}

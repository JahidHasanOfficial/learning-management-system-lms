<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Lesson;
use App\Services\LearningService;
use Illuminate\Http\Request;

class LearningController extends Controller
{
    protected $learningService;

    public function __construct(LearningService $learningService)
    {
        $this->learningService = $learningService;
    }

    public function myCourses()
    {
        $courses = auth()->user()->enrolledCourses()->with('instructor')->get();
        return view('frontend.learning.my-courses', compact('courses'));
    }

    public function player(Course $course, Lesson $lesson = null)
    {
        // Ensure user is enrolled
        if (!auth()->user()->enrolledCourses->contains($course->id)) {
            return redirect()->route('course.show', $course->slug)->with('error', 'You are not enrolled in this course.');
        }

        $course->load(['sections.lessons']);
        
        if (!$lesson) {
            $lesson = $course->lessons->first();
        }

        $progress = $this->learningService->getCourseProgress(auth()->id(), $course->id);

        return view('frontend.learning.player', compact('course', 'lesson', 'progress'));
    }

    public function completeLesson(Request $request, Lesson $lesson)
    {
        $this->learningService->updateProgress(auth()->id(), $lesson->id, [
            'is_completed' => true,
            'completed_at' => now(),
        ]);

        return response()->json(['status' => 'success']);
    }

    public function saveBookmark(Request $request, Lesson $lesson)
    {
        $this->learningService->updateProgress(auth()->id(), $lesson->id, [
            'bookmark_time' => $request->time,
        ]);

        return response()->json(['status' => 'success']);
    }
}

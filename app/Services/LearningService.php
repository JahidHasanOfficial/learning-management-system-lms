<?php

namespace App\Services;

use App\Models\LessonProgress;
use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Support\Facades\Auth;

class LearningService
{
    /**
     * Update lesson progress.
     */
    public function updateProgress($userId, $lessonId, array $data)
    {
        $progress = LessonProgress::updateOrCreate(
            ['user_id' => $userId, 'lesson_id' => $lessonId],
            $data
        );

        if ($progress->is_completed) {
            $progress->update(['completed_at' => now()]);
            $this->recalculateCourseProgress($userId, $lessonId);
        }

        return $progress;
    }

    /**
     * Recalculate course progress percentage.
     */
    protected function recalculateCourseProgress($userId, $lessonId)
    {
        $lesson = Lesson::with('section.course')->find($lessonId);
        if (!$lesson) return;

        $course = $lesson->section->course;
        $totalLessons = $course->lessons()->count();
        if ($totalLessons === 0) return;

        $completedLessons = LessonProgress::where('user_id', $userId)
            ->whereIn('lesson_id', $course->lessons()->pluck('lessons.id'))
            ->where('is_completed', true)
            ->count();

        $percentage = (int) (($completedLessons / $totalLessons) * 100);

        $course->students()->updateExistingPivot($userId, [
            'progress' => $percentage,
            'status' => $percentage === 100 ? 'completed' : 'ongoing',
            'completed_at' => $percentage === 100 ? now() : null,
        ]);
    }

    /**
     * Get user's progress for a course.
     */
    public function getCourseProgress($userId, $courseId)
    {
        $course = Course::with('lessons')->find($courseId);
        $lessonIds = $course->lessons->pluck('id');

        return LessonProgress::where('user_id', $userId)
            ->whereIn('lesson_id', $lessonIds)
            ->get()
            ->keyBy('lesson_id');
    }
}

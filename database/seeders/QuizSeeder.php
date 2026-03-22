<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Quiz;
use App\Models\Course;

class QuizSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) return;

        foreach ($courses as $course) {
            Quiz::create([
                'course_id' => $course->id,
                'title' => 'Fundamentals Quiz - ' . $course->title,
                'description' => 'Test your basic knowledge of ' . $course->title,
                'time_limit' => 30, // 30 minutes
                'pass_percentage' => 40.00,
                'status' => 'active',
            ]);

            Quiz::create([
                'course_id' => $course->id,
                'title' => 'Final Certification Exam - ' . $course->title,
                'description' => 'Comprehensive exam covering all topics in ' . $course->title,
                'time_limit' => 120, // 120 minutes
                'pass_percentage' => 60.00,
                'status' => 'active',
            ]);
        }
    }
}

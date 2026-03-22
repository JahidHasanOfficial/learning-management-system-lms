<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Assignment;
use App\Models\Course;

class AssignmentSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) return;

        foreach ($courses as $course) {
            Assignment::create([
                'course_id' => $course->id,
                'title' => 'Project Research - ' . $course->title,
                'description' => 'Conduct research on ' . $course->title . ' and submit a PDF report.',
                'due_date' => now()->addDays(7),
                'max_marks' => 10,
                'status' => 'active',
            ]);

            Assignment::create([
                'course_id' => $course->id,
                'title' => 'Final Implementation - ' . $course->title,
                'description' => 'Implement the core concept of ' . $course->title . ' and submit your source code.',
                'due_date' => now()->addDays(14),
                'max_marks' => 20,
                'status' => 'active',
            ]);
        }
    }
}

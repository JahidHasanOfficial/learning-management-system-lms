<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Gradebook;
use App\Models\Course;
use App\Models\User;

class GradebookSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        $students = User::role('student')->get();
        if ($students->isEmpty()) {
            $students = User::take(5)->get();
        }

        foreach ($courses as $course) {
            foreach ($students as $student) {
                Gradebook::create([
                    'user_id' => $student->id,
                    'course_id' => $course->id,
                    'average_score' => rand(60, 95),
                    'total_completed_lessons' => rand(1, 10),
                    'status' => 'pass',
                ]);
            }
        }
    }
}

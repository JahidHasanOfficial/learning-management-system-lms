<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::role('Student')->first();
        if (!$student) return;

        $courses = Course::limit(5)->get();
        foreach ($courses as $index => $course) {
            DB::table('course_user')->updateOrInsert(
                ['course_id' => $course->id, 'user_id' => $student->id],
                [
                    'progress' => (10 * $index) + 5, // 5%, 15%, 25%, 35%, 45%
                    'status' => 'ongoing',
                    'enrolled_at' => now()->subDays(5 - $index),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }
}

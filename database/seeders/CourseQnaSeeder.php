<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CourseQna;
use App\Models\Course;
use App\Models\User;

class CourseQnaSeeder extends Seeder
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
                CourseQna::create([
                    'course_id' => $course->id,
                    'user_id' => $student->id,
                    'question' => 'How can I apply ' . $course->title . ' in a real-world scenario?',
                    'answer' => 'Great question! You can use it in ' . $course->title . ' based environments such as business and tech projects.',
                    'answered_by' => User::role('instructor')->first()?->id ?? User::first()?->id,
                    'is_private' => false,
                ]);
            }
        }
    }
}

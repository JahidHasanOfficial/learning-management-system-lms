<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use App\Models\Batch;
use Illuminate\Support\Facades\DB;

class CourseUserSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::role('Student')->get();
        if ($students->isEmpty()) return;

        $courses = Course::all();
        
        foreach ($students as $studentIndex => $student) {
            // Each student enrolls in a subset of courses
            $userCourses = $courses->random(min(3, $courses->count()));
            
            foreach ($userCourses as $course) {
                // Find a batch for this course
                $batchId = Batch::where('course_id', $course->id)->first()->id ?? null;
                
                DB::table('course_user')->updateOrInsert(
                    ['course_id' => $course->id, 'user_id' => $student->id],
                    [
                        'batch_id' => $batchId,
                        'progress' => rand(0, 100),
                        'status' => rand(0, 1) ? 'ongoing' : 'enrolled',
                        'enrolled_at' => now()->subDays(rand(1, 30)),
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]
                );
            }
        }
    }
}

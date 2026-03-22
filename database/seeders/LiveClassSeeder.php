<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LiveClass;
use App\Models\Course;
use App\Models\Batch;

class LiveClassSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) return;

        foreach ($courses as $index => $course) {
            $batch = Batch::where('course_id', $course->id)->first();
            LiveClass::updateOrCreate(
                ['course_id' => $course->id, 'title' => 'Live Strategy Session ' . ($index + 1)],
                [
                    'batch_id' => $batch ? $batch->id : null,
                    'description' => 'A live session discussing deep concepts for ' . $course->title . '.',
                    'start_time' => now()->addDays(1 + $index),
                    'duration' => 60,
                    'join_url' => 'https://zoom.us/j/123456789' . ($index + 1),
                    'provider' => 'zoom'
                ]
            );
        }
    }
}

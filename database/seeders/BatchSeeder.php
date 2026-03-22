<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Batch;
use App\Models\Course;

class BatchSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) return;

        foreach ($courses as $index => $course) {
            Batch::updateOrCreate(
                ['course_id' => $course->id, 'name' => 'March 2026 Batch ' . ($index + 1)],
                [
                    'start_date' => now()->addDays($index * 5),
                    'end_date' => now()->addMonths(3)->addDays($index * 5),
                    'capacity' => 100,
                    'status' => 'active'
                ]
            );
        }
    }
}

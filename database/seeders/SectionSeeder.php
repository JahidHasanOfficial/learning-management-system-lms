<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Section;
use App\Models\Course;

class SectionSeeder extends Seeder
{
    public function run(): void
    {
        $courses = Course::all();
        if ($courses->isEmpty()) return;

        foreach ($courses as $course) {
            $sections = ['Introduction', 'Core Concepts', 'Intermediate Features', 'Advanced Projects', 'Live Q&A Results', 'Certification'];
            foreach ($sections as $index => $title) {
                Section::firstOrCreate(
                    ['course_id' => $course->id, 'title' => $title],
                    ['sort_order' => $index]
                );
            }
        }
    }
}

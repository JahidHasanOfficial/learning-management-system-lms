<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lesson;
use App\Models\Section;

class LessonSeeder extends Seeder
{
    public function run(): void
    {
        $sections = Section::all();
        if ($sections->isEmpty()) return;

        foreach ($sections as $section) {
            $lessonTitles = ['History and Overview', 'Real-world Examples', 'Key Principles & Techniques', 'Deep Dive Analysis', 'Resource Repository'];
            foreach ($lessonTitles as $index => $title) {
                Lesson::firstOrCreate(
                    ['section_id' => $section->id, 'title' => $title],
                    [
                        'type' => $index % 3 == 0 ? 'video' : ($index % 3 == 1 ? 'text' : 'pdf'),
                        'video_url' => 'https://www.youtube.com/embed/ImtZ5yENzgE',
                        'content' => '<p>Master ' . $title . ' in this comprehensive lesson. Learn techniques and tips.</p>',
                        'is_preview' => ($index == 0), // First lesson in each section is preview
                        'sort_order' => $index,
                        'video_duration' => '10:00'
                    ]
                );
            }
        }
    }
}

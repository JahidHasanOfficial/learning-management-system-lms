<?php

namespace App\Services;

use App\Models\Section;
use App\Models\Lesson;
use App\Models\Course;

class CurriculumService
{
    /**
     * Store a new section.
     */
    public function storeSection(array $data)
    {
        return Section::create($data);
    }

    /**
     * Update a section.
     */
    public function updateSection(Section $section, array $data)
    {
        $section->update($data);
        return $section;
    }

    /**
     * Delete a section.
     */
    public function deleteSection(Section $section)
    {
        return $section->delete();
    }

    /**
     * Store a new lesson.
     */
    public function storeLesson(array $data)
    {
        if (isset($data['file_path']) && $data['file_path'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file_path'] = $data['file_path']->store('lessons', 'public');
        }
        return Lesson::create($data);
    }

    /**
     * Update a lesson.
     */
    public function updateLesson(Lesson $lesson, array $data)
    {
        if (isset($data['file_path']) && $data['file_path'] instanceof \Illuminate\Http\UploadedFile) {
            $data['file_path'] = $data['file_path']->store('lessons', 'public');
        }
        $lesson->update($data);
        return $lesson;
    }

    /**
     * Reorder sections or lessons.
     */
    public function reorder(string $type, array $order)
    {
        foreach ($order as $index => $id) {
            if ($type === 'section') {
                Section::where('id', $id)->update(['sort_order' => $index]);
            } else {
                Lesson::where('id', $id)->update(['sort_order' => $index]);
            }
        }
    }
}

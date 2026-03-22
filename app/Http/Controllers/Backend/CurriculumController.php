<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Section;
use App\Models\Lesson;
use App\Services\CurriculumService;
use Illuminate\Http\Request;

class CurriculumController extends Controller
{
    protected $curriculumService;

    public function __construct(CurriculumService $curriculumService)
    {
        $this->curriculumService = $curriculumService;
    }

    public function index(Course $course)
    {
        $course->load('sections.lessons');
        return view('backend.pages.courses.curriculum', compact('course'));
    }

    public function storeSection(Request $request, Course $course)
    {
        $data = $request->validate(['title' => 'required|string|max:255']);
        $data['course_id'] = $course->id;
        $this->curriculumService->storeSection($data);
        return back()->with('success', 'Section added.');
    }

    public function storeLesson(Request $request, Section $section)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'required|in:video,pdf,text,quiz,assignment',
            'content' => 'nullable|string',
            'video_url' => 'nullable|string',
            'is_preview' => 'nullable|boolean'
        ]);
        $data['section_id'] = $section->id;
        $this->curriculumService->storeLesson($data);
        return back()->with('success', 'Lesson added.');
    }

    public function reorder(Request $request)
    {
        $this->curriculumService->reorder($request->type, $request->order);
        return response()->json(['status' => 'success']);
    }
}

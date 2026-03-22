<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Batch;
use App\Models\LiveClass;
use App\Services\LiveClassService;
use Illuminate\Http\Request;

class LiveClassController extends Controller
{
    protected $liveClassService;

    public function __construct(LiveClassService $liveClassService)
    {
        $this->liveClassService = $liveClassService;
    }

    public function index()
    {
        $liveClasses = LiveClass::with(['course', 'batch'])->latest()->paginate(10);
        return view('backend.pages.live_classes.index', compact('liveClasses'));
    }

    public function create()
    {
        $courses = Course::where('instructor_id', auth()->id())->get();
        return view('backend.pages.live_classes.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'course_id' => 'required|exists:courses,id',
            'batch_id' => 'nullable|exists:batches,id',
            'title' => 'required|string|max:255',
            'start_time' => 'required|date',
            'duration' => 'required|integer|min:1',
            'provider' => 'required|in:zoom,jitsi',
            'join_url' => 'nullable|url'
        ]);

        $this->liveClassService->storeLiveClass($data);

        return redirect()->route('live-class.index')->with('success', 'Live class scheduled.');
    }

    public function getBatches($courseId)
    {
        $batches = Batch::where('course_id', $courseId)->get();
        return response()->json($batches);
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Quiz;
use App\Models\QuizQuestion;
use App\Models\Assignment;
use App\Models\AssignmentSubmission;
use App\Models\Course;
use App\Services\AssessmentService;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    protected $assessmentService;

    public function __construct(AssessmentService $assessmentService)
    {
        $this->assessmentService = $assessmentService;
    }

    /**
     * Display a listing of quizzes.
     */
    public function quizIndex()
    {
        $quizzes = Quiz::with('course')->latest()->paginate(10);
        return view('backend.pages.assessments.quizzes.index', compact('quizzes'));
    }

    /**
     * Create a new quiz.
     */
    public function quizCreate()
    {
        $courses = Course::all();
        return view('backend.pages.assessments.quizzes.create', compact('courses'));
    }

    /**
     * Store a new quiz.
     */
    public function quizStore(Request $request)
    {
        $quiz = Quiz::create($request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'time_limit' => 'required|integer|min:0',
            'pass_percentage' => 'required|numeric|between:0,100',
            'status' => 'required|in:active,inactive'
        ]));

        return redirect()->route('quiz.index')->with('success', 'Quiz created successfully.');
    }

    /**
     * Display a listing of assignments.
     */
    public function assignmentIndex()
    {
        $assignments = Assignment::with('course')->latest()->paginate(10);
        return view('backend.pages.assessments.assignments.index', compact('assignments'));
    }

    /**
     * Show submissions for a specific assignment.
     */
    public function assignmentSubmissions(Assignment $assignment)
    {
        $submissions = AssignmentSubmission::where('assignment_id', $assignment->id)->with('user')->latest()->paginate(15);
        return view('backend.pages.assessments.assignments.submissions', compact('assignment', 'submissions'));
    }

    /**
     * Grade a submission.
     */
    public function gradeSubmission(Request $request, $submissionId)
    {
        $this->assessmentService->gradeAssignment($submissionId, $request->marks_awarded, $request->feedback);
        return back()->with('success', 'Submission graded successfully.');
    }
}

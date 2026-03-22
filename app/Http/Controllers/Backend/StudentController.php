<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Course;
use App\Models\Batch;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = User::role('Student')->withCount('enrolledCourses')->latest()->paginate(10);
        return view('backend.pages.students.index', compact('students'));
    }

    /**
     * Display all enrollment records.
     */
    public function enrollments(Request $request)
    {
        $query = \DB::table('course_user')
            ->join('users', 'course_user.user_id', '=', 'users.id')
            ->join('courses', 'course_user.course_id', '=', 'courses.id')
            ->leftJoin('batches', 'course_user.batch_id', '=', 'batches.id')
            ->select('course_user.*', 'users.name as user_name', 'users.email as user_email', 'courses.title as course_title', 'batches.name as batch_name');

        // Apply filters
        if ($request->filled('course_id')) {
            $query->where('course_user.course_id', $request->course_id);
        }
        if ($request->filled('batch_id')) {
            $query->where('course_user.batch_id', $request->batch_id);
        }
        if ($request->filled('from_date')) {
            $query->whereDate('course_user.enrolled_at', '>=', $request->from_date);
        }
        if ($request->filled('to_date')) {
            $query->whereDate('course_user.enrolled_at', '<=', $request->to_date);
        }
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('users.name', 'like', "%{$search}%")
                  ->orWhere('users.email', 'like', "%{$search}%")
                  ->orWhere('courses.title', 'like', "%{$search}%");
            });
        }

        $enrollments = $query->latest('course_user.enrolled_at')->paginate(15)->withQueryString();
        
        $courses = Course::orderBy('title')->get();
        $batches = Batch::orderBy('name')->get();

        return view('backend.pages.students.enrollments', compact('enrollments', 'courses', 'batches'));
    }

    /**
     * Display student learning progress.
     */
    public function progress()
    {
        $students = User::role('Student')
            ->with(['enrolledCourses' => function($query) {
                $query->withPivot('progress', 'status', 'enrolled_at');
            }])
            ->latest()
            ->paginate(10);
            
        return view('backend.pages.students.progress', compact('students'));
    }

    /**
     * Display courses for a specific student.
     */
    public function show(User $user)
    {
        if (!$user->hasRole('Student')) {
            abort(404);
        }

        $user->load(['enrolledCourses' => function($query) {
            $query->withPivot('progress', 'status', 'enrolled_at', 'completed_at');
        }]);

        return view('backend.pages.students.show', compact('user'));
    }
}

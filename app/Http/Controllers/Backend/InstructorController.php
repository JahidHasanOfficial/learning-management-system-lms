<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    /**
     * Display a listing of all instructors as cards.
     */
    public function index(Request $request)
    {
        $query = User::role('Instructor');

        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->search . '%')
                  ->orWhere('email', 'LIKE', '%' . $request->search . '%');
            });
        }

        $instructors = $query->latest()->paginate(12);

        return view('backend.pages.instructors.index', compact('instructors'));
    }

    /**
     * Display the specific instructor details/courses.
     */
    public function show(User $user)
    {
        if (!$user->hasRole('Instructor')) {
            abort(404);
        }

        $user->load('courses');

        return view('backend.pages.instructors.show', compact('user'));
    }
}

<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->hasRole(['Admin', 'Super Admin'])) {
            $data['total_students'] = User::role('Student')->count();
            $data['total_instructors'] = User::role('Instructor')->count();
            $data['total_courses'] = Course::count();
            $data['total_admins'] = User::role(['Admin', 'Super Admin'])->count();
            $data['recent_logins'] = \App\Models\LoginHistory::with('user')->latest()->limit(10)->get();
            return view('backend.pages.dashboard', $data);
        }

        if ($user->hasRole('Instructor')) {
            $data['total_courses'] = Course::where('instructor_id', $user->id)->count();
            // Add more instructor specific stats here
            return view('backend.pages.dashboard_instructor', $data);
        }

        if ($user->hasRole('Student')) {
            $data['enrolled_courses'] = 0; // Will be implemented with enrollment logic
            $data['completed_courses'] = 0;
            return view('backend.pages.dashboard_student', $data);
        }

        return view('backend.pages.dashboard');
    }
}

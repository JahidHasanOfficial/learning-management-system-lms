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
        $data['total_students'] = User::role('Student')->count();
        $data['total_instructors'] = User::role('Instructor')->count();
        $data['total_courses'] = Course::count();
        $data['total_admins'] = User::role(['Admin', 'Super Admin'])->count();
        
        return view('backend.pages.dashboard', $data);
    }
}

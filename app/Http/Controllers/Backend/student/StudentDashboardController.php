<?php

namespace App\Http\Controllers\Backend\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentDashboardController extends Controller
{
    public function __invoke()
    {
        // Your code here

        //return $studentData = Session::get('student_user_data');
         $adminUserData = Session::get('student_user_data');

        return view('backend.dashboard', compact('adminUserData')); // Pass 'adminUserData' to the view
    }
}

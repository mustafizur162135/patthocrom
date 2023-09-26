<?php

namespace App\Http\Controllers\Backend\teacher;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherDashboardController extends Controller
{
    public function __invoke()
    {
        $adminUserData = Session::get('teacher_user_data');

        return view('backend.dashboard', compact('adminUserData')); // Pass 'adminUserData' to the view
    }
}

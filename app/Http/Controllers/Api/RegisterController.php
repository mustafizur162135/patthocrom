<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use App\Http\Requests\StudentRegisterRequest;
use App\Http\Requests\TeacherRegisterRequest;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use App\Models\Teacher;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    public function register(RegisterRequest $request)
    {
        // Register user with 'admin' guard
        $user = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Assign the 'user' role for the 'admin' guard
        $userRole = Role::where(['name' => 'user', 'guard_name' => 'admin'])->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        // Authenticate the user with 'admin' guard
        if (!Auth::guard('admin')->attempt($request->only('email', 'password'))) {

            // Handle authentication failure here
            Helper::sendError('Email Or Password is wrong !!!');
        }

        return response()->json(new UserResource(Auth::guard('admin')->user()));
    }

    public function registerTeacher(TeacherRegisterRequest $request)
    {
        // Register user with 'teacher' guard
        $user = Teacher::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Assign the 'teacher' role for the 'teacher' guard
        $userRole = Role::where(['name' => 'teacher', 'guard_name' => 'teacher'])->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        // Authenticate the user with 'teacher' guard
        if (!Auth::guard('teacher')->attempt($request->only('email', 'password'))) {

            // Handle authentication failure here
            Helper::sendError('Email Or Password is wrong !!!');
        }

        return response()->json(new UserResource(Auth::guard('teacher')->user()));
    }

    public function registerStudent(StudentRegisterRequest $request)
    {
        // Register user with 'student' guard
        $user = Student::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        // Assign the 'student' role for the 'student' guard
        $userRole = Role::where(['name' => 'student', 'guard_name' => 'student'])->first();
        if ($userRole) {
            $user->assignRole($userRole);
        }

        // Authenticate the user with 'student' guard
        if (!Auth::guard('student')->attempt($request->only('email', 'password'))) {

            // Handle authentication failure here
            Helper::sendError('Email Or Password is wrong !!!');
        }

        return response()->json(new UserResource(Auth::guard('student')->user()));
    }
}

<?php

namespace App\Http\Controllers\Backend\teacher;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\TeacherController;
use App\Http\Controllers\Controller;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Requests\TeacherRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class TeacherLoginController extends Controller
{
    private $apiController;
    private $registerApiController;

    public function __construct(TeacherController $apiController, RegisterController $registerApiController)
    {
        $this->apiController = $apiController;
        $this->registerApiController = $registerApiController;
    }

    public function showLoginForm()
    {
        return view('auth.teacher.login');
    }

    public function teacherLogin(Request $request)
    {
        $loginRequest = new TeacherLoginRequest([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        try {
            $apiResponse = $this->apiController->login($loginRequest);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Authentication failed. ');
        } catch (\Exception $e) {
            return back()->with('error', 'Login failed. Please check your credentials.');
        }

        if ($apiResponse->getStatusCode() === 200) {
            $userData = json_decode($apiResponse->getContent(), true);
            Session::put('teacher_user_data', $userData);
            return redirect()->route('teacher.dashboard');
        }

        return back()->with('error', 'Login failed. Please check your credentials.');
    }



    public function teacherRegister(Request $request)
    {
        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        if ($password !== $confirmPassword) {
            return back()->with('error', 'Password and confirm password do not match.');
        }

        $registerRequest = new TeacherRegisterRequest([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        try {
            $apiResponse = $this->registerApiController->registerTeacher($registerRequest);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Registration failed. ');
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please check your credentials.');
        }

        if ($apiResponse->getStatusCode() === 200) {
            return redirect()->route('teacher.dashboard');
        }

        return back()->with('error', 'Registration failed. Please check your credentials.');
    }
}
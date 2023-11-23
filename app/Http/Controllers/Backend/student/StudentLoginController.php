<?php

namespace App\Http\Controllers\Backend\student;

use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\StudentController;
use App\Http\Controllers\Controller;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Requests\StudentRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StudentLoginController extends Controller
{
    private $apiController;

    private $registerApiController;

    public function __construct(StudentController $apiController, RegisterController $registerApiController)
    {
        $this->apiController = $apiController;
        $this->registerApiController = $registerApiController;
    }

    public function showLoginForm()
    {
        return view('auth.student.login');
    }

    public function studentLogin(Request $request)
    {

        $loginRequest = new StudentLoginRequest([
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

            Session::put('student_user_data', $userData);

            return redirect()->route('student.dashboard');
        }

        return back()->with('error', 'Login failed. Please check your credentials.');
    }

    public function registerStudent(Request $request)
    {

        $password = $request->input('password');
        $confirmPassword = $request->input('confirm_password');

        if ($password !== $confirmPassword) {
            return back()->with('error', 'Password and confirm password do not match.');
        }

        $registerRequest = new StudentRegisterRequest([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $password,
        ]);

        try {
            $apiResponse = $this->registerApiController->registerStudent($registerRequest);

        } catch (HttpResponseException $e) {
            return back()->with('error', 'Registration failed. ');
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please check your credentials.');
        }

        if ($apiResponse->getStatusCode() === 200) {
            $userData = json_decode($apiResponse->getContent(), true);
            Session::put('student_user_data', $userData);

            return redirect()->route('student.dashboard');
        }

        return back()->with('error', 'Registration failed. Please check your credentials.');
    }
}

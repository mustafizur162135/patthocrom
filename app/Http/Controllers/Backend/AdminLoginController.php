<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\TeacherRegisterRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    private $loginApiController;
    private $registerApiController;

    public function __construct(LoginController $loginApiController, RegisterController $registerApiController)
    {
        $this->loginApiController = $loginApiController;
        $this->registerApiController = $registerApiController;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function adminLogin(Request $request)
    {
        $loginRequest = new LoginRequest([
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        try {
            $apiResponse = $this->loginApiController->login($loginRequest);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Authentication failed. ');
        } catch (\Exception $e) {
            return back()->with('error', 'Login failed. Please check your credentials.');
        }

        if ($apiResponse->getStatusCode() === 200) {
            $userData = json_decode($apiResponse->getContent(), true);
            Session::put('admin_user_data', $userData);
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Login failed. Please check your credentials.');
    }

    public function teacherRegister(Request $request)
    {
        $registerRequest = new TeacherRegisterRequest([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => $request->input('password'),
        ]);

        try {
            $apiResponse = $this->registerApiController->register($registerRequest->toRegisterRequest());
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Registration failed. ');
        } catch (\Exception $e) {
            return back()->with('error', 'Registration failed. Please check your credentials.');
        }

        if ($apiResponse->getStatusCode() === 200) {
            $userData = json_decode($apiResponse->getContent(), true);
            Session::put('teacher_user_data', $userData);
            return redirect()->route('teacher.dashboard');
        }

        return back()->with('error', 'Registration failed. Please check your credentials.');
    }

    public function logout()
    {
        
        try {

            Auth::logout();
            // Your existing logout logic
            Session::forget('admin_user_data');
            
            // Redirect to the login page
            return redirect()->route('admin.login.form');
        } catch (\Exception $e) {
            // Log the error (you can customize this based on your logging setup)
            \Log::error('Logout error: ' . $e->getMessage());
    
            // You can customize the error response based on your needs
            return redirect()->back()->with('error', 'An error occurred during logout. Please try again.');
        }
    }
}
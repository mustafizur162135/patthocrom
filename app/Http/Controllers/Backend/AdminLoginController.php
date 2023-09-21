<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Cache;

class AdminLoginController extends Controller
{
    protected $apiController;

    public function __construct(LoginController $apiController)
    {
        $this->apiController = $apiController;
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        // Use the existing API login method from LoginController
        $response = $this->apiController->login($request);
        // Decode the JSON response
        $data = json_decode($response->getContent(), true);
        // Check if the user is authenticated after the API 
        // Check if the user is authenticated after the API 
        if (isset($data['token'])) {
           
            $token = $data['token'];

            // Create an associative array containing user data and token
            $userData = [
                'user_id' => $data['data_id'],
                'name' => $data['name'],
                'email' => $data['email'],
                'guard' => $data['guard'],
                'roles' => $data['roles'],
                'roles_permissions' => $data['roles_permissions'],
                'token' => $token,
            ];

            // Store the user data and token in the cache with a specified key
            $cacheKey = 'user_data_' . $data['user_id'];
            Cache::put($cacheKey, $userData, now()->addMinutes(30)); // Adjust the expiration time as needed
            return response()->json(['message' => 'Login successful']);
        }else {
            // Handle the case where the API login was not successful
            return response()->json(['message' => 'Authentication failed'], 401);
        }
    }
}

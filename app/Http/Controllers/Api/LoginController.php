<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\Admin;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade
use Spatie\Permission\Models\Role;

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
    
        // login user
        if(!Auth::guard('admin')->attempt($request->only('email','password'))){
          
            Helper::sendError('Email Or Password is wroing !!!');
        }



        // send response
        $user= new UserResource(Auth::guard('admin')->user());

        return response()->json($user);
    
    }


    public function index()
    {
        try {
            $admins = Admin::with('roles')->get();
    
            if ($admins->isEmpty()) {
                // Handle the case when there are no roles found.
                return response()->json([
                    'status' => 404,
                    'message' => 'No Admin found.',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'This is the index function for LoginController',
                'admins' => $admins
            ]);
        } catch (\Exception $e) {
            // Handle any other unexpected errors.
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
    

    
    public function create()
    {
        try {
           

            $roles = Role::where('guard_name', 'admin')->get();
           
            return response()->json([
                'status' => 200,
                'message' => 'This is the create function for Roles',
                'roles' => $roles
            ]);
        } catch (\Throwable $th) {
            return response()->json([
            'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        // Optionally, you can return a response indicating successful logout.
        return response()->json(['message' => 'Logout successful']);
    }


}






<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Auth; // Import the Auth facade

class LoginController extends Controller
{
    public function login(LoginRequest $request)
    {
    
        // login user
        if(!Auth::guard('admin')->attempt($request->only('email','password'))){
          
            Helper::sendError('Email Or Password is wroing !!!');
        }



        // send response
        $user= new UserResource(Auth::guard('admin')->user());

        return response()->json($user);
    
    }




    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        
        // Optionally, you can return a response indicating successful logout.
        return response()->json(['message' => 'Logout successful']);
    }


}






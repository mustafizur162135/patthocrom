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
            return response()->json(['message' => 'Logout successful']);
        }


}






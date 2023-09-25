<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Http\Requests\StudentLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth; // Import the Auth facade


class StudentController extends Controller
{
    public function login(StudentLoginRequest $request)
    {
  
        // login user
        if(!Auth::guard('student')->attempt($request->only('email','password'))){
          
            Helper::sendError('Email Or Password is wroing !!!');
        }



        // send response
        
        $user= new UserResource(Auth::guard('student')->user());

        return response()->json($user);
    }
}

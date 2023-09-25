<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Helpers\Helper;
use App\Http\Requests\TeacherLoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth; // Import the Auth facade


class TeacherController extends Controller
{
    public function login(TeacherLoginRequest $request)
    {
       
        // login user
        if(!Auth::guard('teacher')->attempt($request->only('email','password'))){
          
            Helper::sendError('Email Or Password is wroing !!!');
        }



        // send response

        $user= new UserResource(Auth::guard('teacher')->user());

        return response()->json($user);
    }
}


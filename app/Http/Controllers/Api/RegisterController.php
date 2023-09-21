<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Http\Helpers\Helper;
use App\Http\Resources\UserResource;
use App\Models\Admin;
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

        return new UserResource(Auth::guard('admin')->user());
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AuthenticateStudent
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Check if the 'admin_user_data' session variable exists, indicating admin authentication.
        if (Session::has('student_user_data')) {
            return $next($request);
        }

        // If the session variable does not exist, redirect to the admin login form.
        return redirect()->route('student.login.form')->with('error', 'Authentication required.');
    }
}

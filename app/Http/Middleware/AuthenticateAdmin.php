<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;

class AuthenticateAdmin
{
    public function handle($request, Closure $next)
    {
        // Check if the 'admin_user_data' session variable exists, indicating admin authentication.
        if (Session::has('admin_user_data')) {
            return $next($request);
        }

        // If the session variable does not exist, redirect to the admin login form.
        return redirect()->route('admin.login.form')->with('error', 'Authentication required.');
    }
}

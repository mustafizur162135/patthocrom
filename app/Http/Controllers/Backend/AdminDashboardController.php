<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke()
    {
        // Add your admin dashboard logic here
        // You can fetch data, perform actions, etc.
        // For example, you can return a view:

        return view('backend.dashboard'); // Assuming you have a Blade view named 'dashboard' in 'resources/views/admin'
    }
}

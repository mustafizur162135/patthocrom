<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;


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


         $adminUserData = Session::get('admin_user_data');
    
        return view('backend.dashboard', compact('adminUserData')); // Pass 'adminUserData' to the view
    }
    

}

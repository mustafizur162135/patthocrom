<?php

namespace App\Http\Controllers\Backend\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studentorder;

class OrderController extends Controller
{
    public function index(){
         $order=Studentorder::all();
        return view('backend.order.index');
    }
}

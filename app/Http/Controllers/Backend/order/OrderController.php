<?php

namespace App\Http\Controllers\Backend\order;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Studentorder;

class OrderController extends Controller
{
    public function index(){
         $orders = Studentorder::with('student', 'studentPackage')
        ->where('guard', 'student')
        ->get();
    
        return view('backend.order.index', compact('orders'));
    }

    public function show(Studentorder $order)
    {
        $order->load('student', 'studentPackage');
        return view('backend.order.show', compact('order'));
    }
    public function updateStatus(Request $request, Studentorder $order)
    {
        try {
            // Validate the request if necessary
            $request->validate([
                'status' => 'required|in:0,1',
            ]);

            // Update the status
            $order->update(['studentorder_status' => $request->status]);

            return response()->json(['message' => 'Status updated successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error updating status'], 500);
        }
    }
}
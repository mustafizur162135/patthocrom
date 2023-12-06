<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Models\Studentorder;
use App\Models\Studentpackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckoutController extends Controller
{
    public function studentCheckout(Request $request)
    {
        $setting = Setting::first();

         $studentUserData = Session::get('student_user_data');

        // Retrieve the course ID from the POST request
        $studentPackage_id = $request->input('studentPackage_id');
        $studentpackage_price = $request->input('studentpackage_price');
        $studentpackage_name = $request->input('studentpackage_name');

        return view('frontend.checkout.studentCheckout', compact('setting', 'studentUserData', 'studentPackage_id', 'studentpackage_price', 'studentpackage_name'));
    }

    public function studentCheckoutProcess(Request $request)
    {

        // Retrieve 'student_id' from session data
        $studentUserData = Session::get('student_user_data');
        $student_id = $studentUserData['user_id'];

        // Retrieve 'studentpackage_id' from the request
        $studentpackageId = $request->input('studentpackage_id');
        $studentorder_name = $request->input('studentorder_name');
        $studentpackage_name = $request->input('studentpackage_name');
        $studentpackage_price = $request->input('studentpackage_price');
        $studentorder_phone = $request->input('studentorder_phone');
        $studentorder_email = $request->input('studentorder_email');
        $studentorder_zipcode = $request->input('studentorder_zipcode');
        $studentorder_address = $request->input('studentorder_address');
        $studentorder_city = $request->input('studentorder_city');
        $studentorder_card_type = $request->input('studentorder_card_type');
        $nagadTranId = $request->input('nagadTranId');
        $bkashTranId = $request->input('bkashTranId');

        // Check the selected payment method
        if ($studentorder_card_type === 'nagad') {
            // Use the correct variable name
            $nagadTranId = $request->input('nagadTranId');
            $bkashTranId = null; // Set bkashTranId to null if it's not selected
        } elseif ($studentorder_card_type === 'bkash') {
            // Use the correct variable name
            $bkashTranId = $request->input('bkashTranId');
            $nagadTranId = null; // Set nagadTranId to null if it's not selected
        } else {
            $nagadTranId = null;
            $bkashTranId = null;
        }


        //return $bkashTranId;

        // $studentorder_tran_id = $request->input('studentorder_tran_id');

        // Define validation rules for the form fields
        $rules = [
            'studentorder_phone' => 'required|regex:/^[0-9]{11}$/',
            'studentorder_address' => 'required|string',
            // Add more validation rules as needed
            // Add more rules for other fields
        ];

        // Custom error messages (optional)
        $messages = [
            'studentorder_phone.required' => 'Phone Number is required.',
            'studentorder_address.required' => 'Address is required.',
            // Add more custom error messages as needed
        ];



        // Validate the incoming request data
        $validatedData = $request->validate($rules, $messages);



        // Generate a unique order code
        $uniqueOrderCode = $this->generateUniqueOrderCode();


        // Create a new StudentOrder instance with the validated data
        $studentOrder = new StudentOrder([
            'student_id' => $student_id,
            'studentpackage_id' => $studentpackageId,
            'studentorder_name' => $studentorder_name,
            'studentpackage_name' => $studentpackage_name,
            'studentpackage_price' => $studentpackage_price,
            'studentorder_phone' => $studentorder_phone,
            'studentorder_email' => $studentorder_email,
            'studentorder_address' => $studentorder_address,
            'studentorder_zipcode' => $studentorder_zipcode,
            'studentorder_city' => $studentorder_city,
            'studentorder_code' => $uniqueOrderCode, // You can generate a unique code, e.g., using a function
            'studentorder_date' => now(), // Use the current date and time
            'studentorder_card_type' => $studentorder_card_type, // Assuming you've added 'card_type' to your form
            'nagadTranId' => $nagadTranId, // Assuming you've added 'studentorder_tran_id' to your form
            'bkashTranId' => $bkashTranId, // Assuming you've added 'studentorder_tran_id' to your form
            'studentorder_status' => 1, // You can set the initial status here
        ]);


        // Save the StudentOrder to the database
        $studentOrder->save();


        // Fetch additional data for the confirmation page
        $studentPackage = Studentpackage::find($studentpackageId);
        $studentpackage_name = $studentPackage->studentpackage_name;
        // Redirect the user to the confirmation page with the necessary data
        return redirect()->route('student.checkout.confirmation', [
            'studentpackage_name' => $studentpackage_name,
            'studentorder_code' => $studentOrder->studentorder_code, // Use the actual order code from the created StudentOrder
            // Add other data as needed
        ]);
    }

    public function studentCheckoutConfirmation(Request $request)
    {
        $setting = Setting::first();
        $studentUserData = Session::get('student_user_data');

        $studentpackage_name = $request->input('studentpackage_name');
        $studentorder_code = $request->input('studentorder_code');

        // Add any other data retrieval or processing needed for the confirmation page

        return view('frontend.checkout.confirmation', compact('setting', 'studentUserData', 'studentpackage_name', 'studentorder_code'));
    }

    // Function to generate a unique order code
    private function generateUniqueOrderCode()
    {
        // You can use a combination of timestamps, random characters, or any method you prefer
        return 'STUDENTORDER_'.uniqid(); // Example: ORDER_5f4db6c8a3b7d
    }
}

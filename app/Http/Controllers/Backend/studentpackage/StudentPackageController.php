<?php

namespace App\Http\Controllers\Backend\studentpackage;

use App\Http\Controllers\Controller;
use App\Models\Exam;
use App\Models\Note;
use App\Models\Studentpackage;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Helper;

class StudentPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studentpackages = Studentpackage::get();

        return view('backend.studentpackage.index', compact('studentpackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $exams = Exam::get();
        $notes = Note::get();

        return view('backend.studentpackage.create', compact('exams', 'notes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'studentpackage_name' => 'required|string',
            'studentpackage_price' => 'required',
            'exam_id' => 'required|array',
            'note_id' => 'required|array',
            'studentpackage_des' => 'nullable|string',
            'studentpackage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload and resize
        if ($request->hasFile('studentpackage_image')) {
            $image = $request->file('studentpackage_image');
            $imageName = time() . '_studentpackage.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/studentpackages', $imageName);

            // Resize the image using Intervention Image
            $resizedImage = Image::make(storage_path('app/' . $path))
                ->resize(307, 200) // Adjust the dimensions as needed
                ->save();

            // Create a new Studentpackage model
            $studentpackage = new Studentpackage();
            $studentpackage->guard = Helper::activeGuard();
            $studentpackage->studentpackage_name = $request->input('studentpackage_name');
            $studentpackage->studentpackage_price = $request->input('studentpackage_price');
            $studentpackage->studentpackage_des = $request->input('studentpackage_des');
            $studentpackage->studentpackage_image = $imageName; // Store the original image name
            $studentpackage->save();

            // Attach related exams and notes to the student package
            $studentpackage->exams()->attach($request->input('exam_id'));
            $studentpackage->notes()->attach($request->input('note_id'));

            // Redirect or return a response
            return redirect()->route('studentpackages.index')->with('success', 'Student package created successfully.');
        } else {
            // Handle the case where no image was uploaded
            return redirect()->back()->with('error', 'Image upload failed.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $studentpackage = studentpackage::find($id);

        $exams = Exam::get();

        $notes = Note::get();

        return view('backend.studentpackage.edit', compact('studentpackage', 'exams', 'notes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request;
        // Validate the request data
        $request->validate([
            'studentpackage_name' => 'required|string',
            'exam_id' => 'required',
            'studentpackage_price' => 'required',
            'studentpackage_des' => 'nullable|string',
            'studentpackage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the studentpackage by its ID
        $studentpackage = studentpackage::find($id);

        if (!$studentpackage) {
            return redirect()->route('studentpackages.index')->with('error', 'studentpackage not found.');
        }

        // Handle the image upload and update if a new image is provided
        if ($request->hasFile('studentpackage_image')) {
            // Get the old image file name
            $oldImage = $studentpackage->studentpackage_image;

            // Remove the old image file if it exists
            if (!empty($oldImage) && File::exists(public_path('images/studentpackages/' . $oldImage))) {
                File::delete(public_path('images/studentpackages/' . $oldImage));
            }

            $image = $request->file('studentpackage_image');
            $imageName = time() . '_studentpackage.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/studentpackages');

            // Move the new image to the destination path
            $image->move($destinationPath, $imageName);

            // Resize the image using Intervention Image
            $resizedImage = Image::make($destinationPath . '/' . $imageName)
                ->resize(307, 200) // Adjust the dimensions as needed
                ->save();

            // Update the studentpackage image field with the new image name
            $studentpackage->studentpackage_image = $imageName;
        }

        // Update other fields
        $studentpackage->guard = Helper::activeGuard();
        $studentpackage->exam_id = $request->input('exam_id');
        $studentpackage->studentpackage_name = $request->input('studentpackage_name');
        $studentpackage->studentpackage_price = $request->input('studentpackage_price');
        $studentpackage->studentpackage_des = $request->input('studentpackage_des');

        // Save the updated studentpackage
        $studentpackage->save();

        // Redirect or return a response
        return redirect()->route('studentpackages.index')->with('success', 'studentpackage updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Find the studentpackage by its ID
        $studentpackage = studentpackage::find($id);

        if (!$studentpackage) {
            return redirect()->route('studentpackages.index')->with('error', 'studentpackage not found.');
        }

        // Get the image file name to be deleted
        $imageToDelete = $studentpackage->studentpackage_image;

        // Remove the image file from storage
        if (!empty($imageToDelete) && File::exists(public_path('images/studentpackages/' . $imageToDelete))) {
            File::delete(public_path('images/studentpackages/' . $imageToDelete));
        }

        // Delete the studentpackage record from the database
        $studentpackage->delete();

        // Redirect or return a response
        return redirect()->route('studentpackages.index')->with('success', 'studentpackage deleted successfully.');
    }


    public function studentBuyPackageList()
    {

        if (Helper::activeGuard() == "student") {
            $adminUserData = Session::get('student_user_data');
            $userID = $adminUserData['user_id'];
            $student = Student::with('orders')->where('id', $userID)->first();
            $studentOrder = $student->orders;

            // Get all package IDs the user has bought
            $boughtPackageIds = $studentOrder->pluck('studentpackage_id')->all();

            // Get packages that the user has not bought
            $studentPackages = Studentpackage::whereNotIn('id', $boughtPackageIds)->get();

            return view('backend.studentBuyPackage.index', compact('studentPackages'));
        } else {
            $adminUserData = Session::get('teacher_user_data');

            $userID = $adminUserData['user_id'];

            $student = Teacher::with('orders')->where('id', $userID)->first();
            $studentOrder = $student->orders;

            // Get all package IDs the user has bought
            $boughtPackageIds = $studentOrder->pluck('studentpackage_id')->all();

            // Get packages that the user has not bought
            $teacherPackages = TeacherPackage::whereNotIn('id', $boughtPackageIds)->get();

            return view('backend.studentBuyPackage.teacher', compact('teacherPackages'));
        }





    }

}

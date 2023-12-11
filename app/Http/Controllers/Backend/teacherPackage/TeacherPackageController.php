<?php

namespace App\Http\Controllers\Backend\teacherPackage;

use App\Http\Controllers\Controller;
use App\Models\TeacherPackage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class TeacherPackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $TeacherPackages = TeacherPackage::get();

        return view('backend.TeacherPackages.index', compact('TeacherPackages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.TeacherPackages.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $request->validate([
            'teacherpackage_name' => 'required|unique:teacher_packages',
            'teacherpackage_price' => 'required',
            'teacherpackage_des' => 'required',
            'teacherpackage_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_of_question_print' => 'required',
        ]);
    
        if ($request->hasFile('teacherpackage_image')) {
            $image = $request->file('teacherpackage_image');
            $imageName = time() . '_teacherpackage.' . $image->getClientOriginalExtension();
            $path = $image->storeAs('public/images/teacherpackages', $imageName);
    
            // Resize the image using Intervention Image
            $resizedImage = Image::make(storage_path('app/' . $path))
                ->resize(307, 200) // Adjust the dimensions as needed
                ->save(storage_path('app/' . $path)); // Save the resized image with the same filename
    
            // Create a new TeacherPackage model
            $teacherpackage = new TeacherPackage();
            $teacherpackage->teacherpackage_name = $request->input('teacherpackage_name');
            $teacherpackage->teacherpackage_price = $request->input('teacherpackage_price');
            $teacherpackage->no_of_question_print = $request->input('no_of_question_print');
            $teacherpackage->teacherpackage_des = $request->input('teacherpackage_des');
            $teacherpackage->teacherpackage_image = $imageName; // Store the original image name
            $teacherpackage->save();
    
            return redirect()->route('teacherpackages.index')->with('success', 'Teacher package created successfully.');
    
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
        $teacherPackage = TeacherPackage::find($id);

        return view('backend.TeacherPackages.edit', compact('teacherPackage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'teacherpackage_name' => 'required',
            'teacherpackage_price' => 'required',
            'teacherpackage_des' => 'required',
            'new_teacherpackage_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'no_of_question_print' => 'required',
        ]);
    
        // Retrieve the TeacherPackage instance from the database
        $teacherPackage = TeacherPackage::findOrFail($id);
    
        // Update other fields
        $teacherPackage->update([
            'teacherpackage_name' => $request->input('teacherpackage_name'),
            'teacherpackage_price' => $request->input('teacherpackage_price'),
            'no_of_question_print' => $request->input('no_of_question_print'),
            'teacherpackage_des' => $request->input('teacherpackage_des'),
        ]);
    
        // Handle the new image upload if provided
        if ($request->hasFile('new_teacherpackage_image')) {
            // Delete the old image if it exists
            if ($teacherPackage->teacherpackage_image) {
                Storage::delete('public/images/teacherpackages/' . $teacherPackage->teacherpackage_image);
            }
    
            // Upload the new image
            $newImageName = time() . '_teacherpackage.' . $request->file('new_teacherpackage_image')->getClientOriginalExtension();
            $path = $request->file('new_teacherpackage_image')->storeAs('public/images/teacherpackages', $newImageName);
    
            // Resize the image using Intervention Image
            Image::make(storage_path('app/' . $path))
                ->resize(307, 200) // Adjust the dimensions as needed
                ->save(storage_path('app/' . $path));
    
            // Update the database with the new image name
            $teacherPackage->update(['teacherpackage_image' => $newImageName]);
        }
    
        return redirect()->route('teacherpackages.index')->with('success', 'Teacher package updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
{
    // Retrieve the TeacherPackage instance from the database
    $teacherPackage = TeacherPackage::findOrFail($id);

    // Delete the associated image if it exists
    if ($teacherPackage->teacherpackage_image) {
        Storage::delete('public/images/teacherpackages/' . $teacherPackage->teacherpackage_image);
    }

    // Delete the TeacherPackage record from the database
    $teacherPackage->delete();

    return redirect()->route('teacherpackages.index')->with('success', 'Teacher package deleted successfully.');
}
}

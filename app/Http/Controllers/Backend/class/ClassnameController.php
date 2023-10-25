<?php

namespace App\Http\Controllers\Backend\class;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ClassNamController;
use App\Http\Requests\ClassNameRequest;
use App\Models\Classname;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;

class ClassnameController extends Controller
{
    public function index()
    {
        $classes = Classname::all(); // Assuming ClassName is your model
        return view('backend.class.index', compact('classes'));
    }

    public function create()
    {
        return view('backend.class.form');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'class_name' => 'required',
            'class_code' => 'required',
            'class_note' => 'nullable',
            'class_price' => 'nullable',
            'class_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        ]);

        if ($request->hasFile('class_image')) {
            $image = $request->file('class_image');
            $imagePath = 'images/courses/' . time() . '_class_image.' . $image->getClientOriginalExtension();
    
            // Resize and store the image
            Image::make($image)->resize(307, 200)->save(public_path($imagePath));
    
            $data['class_image'] = $imagePath;
        }

        ClassName::create($data);

        return redirect()->route('admin.class')->with('success', 'Class created successfully.');
    }

    public function edit($id)
    {
        $class = ClassName::find($id);
        return view('backend.class.form', compact('class'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'class_name' => 'required',
            'class_code' => 'required',
            'class_note' => 'nullable',
            'class_price' => 'nullable',
            'class_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Example validation rules for image upload
        ]);
    
        $class = ClassName::find($id);
    
        if ($request->hasFile('class_image')) {

             // Get the old image file name
             $oldImage = $class->class_image;

             // Remove the old image file if it exists
             if (!empty($oldImage) && File::exists(public_path('images/courses/' . $oldImage))) {
                 File::delete(public_path('images/courses/' . $oldImage));
             }

            // $previousImage = public_path('images/courses/') . $class->class_image;
    
            // if (file_exists($previousImage) && is_file($previousImage)) {
            //     unlink($previousImage);
            // }
    
            $image = $request->file('class_image');
            $imagePath = 'images/courses/' . time() . '_class_image.' . $image->getClientOriginalExtension();
    
            // Resize and store the new image
            Image::make($image)->resize(307, 200)->save(public_path($imagePath));
    
            $data['class_image'] = $imagePath;
        }
    
        $class->update($data);
    
        return redirect()->route('admin.class')->with('success', 'Class updated successfully.');
    }

    public function delete($id)
{
    $class = ClassName::find($id);

    if (!$class) {
        return redirect()->route('admin.class')->with('error', 'Class not found.');
    }

    // Get the image file name to be deleted
    $imageToDelete = $class->class_image;

    // Remove the image file from storage
    if (!empty($imageToDelete) && file_exists(public_path('images/courses/' . $imageToDelete))) {
        unlink(public_path('images/courses/' . $imageToDelete));
    }

    // Delete the class record from the database
    $class->delete();

    return redirect()->route('admin.class')->with('success', 'Class deleted successfully.');
}


}

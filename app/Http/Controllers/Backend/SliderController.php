<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::get();

        return view('backend.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('backend.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'slider_name' => 'nullable|string',
            'slider_des' => 'nullable|string',
            'slider_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle the image upload and resize
        if ($request->hasFile('slider_image')) {
            $image = $request->file('slider_image');
            $imageName = time() . '_slider.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/sliders');

            // Move the image to the destination path
            $image->move($destinationPath, $imageName);

            // Resize the image using Intervention Image
            $resizedImage = Image::make($destinationPath . '/' . $imageName)
                ->resize(1920, 729) // Adjust the dimensions as needed
                ->save();

            // Create a new Slider model
            $slider = new Slider();
            $slider->slider_name = $request->input('slider_name');
            $slider->slider_des = $request->input('slider_des');
            $slider->slider_image = $imageName; // Store the original image name
            $slider->save();

            // Redirect or return a response
            return redirect()->route('sliders.index')->with('success', 'Slider created successfully.');
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
        $slider = Slider::find($id);

        return view('backend.slider.edit', compact('slider'));
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
        // Validate the request data
        $request->validate([
            'slider_name' => 'nullable|string',
            'slider_des' => 'nullable|string',
            'slider_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Find the slider by its ID
        $slider = Slider::find($id);

        if (!$slider) {
            return redirect()->route('sliders.index')->with('error', 'Slider not found.');
        }

        // Handle the image upload and update if a new image is provided
        if ($request->hasFile('slider_image')) {
            // Get the old image file name
            $oldImage = $slider->slider_image;

            // Remove the old image file if it exists
            if (!empty($oldImage) && File::exists(public_path('images/sliders/' . $oldImage))) {
                File::delete(public_path('images/sliders/' . $oldImage));
            }

            $image = $request->file('slider_image');
            $imageName = time() . '_slider.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('images/sliders');

            // Move the new image to the destination path
            $image->move($destinationPath, $imageName);

            // Resize the image using Intervention Image
            $resizedImage = Image::make($destinationPath . '/' . $imageName)
                ->resize(1920, 729) // Adjust the dimensions as needed
                ->save();

            // Update the slider image field with the new image name
            $slider->slider_image = $imageName;
        }

        // Update other fields
        $slider->slider_name = $request->input('slider_name');
        $slider->slider_des = $request->input('slider_des');

        // Save the updated slider
        $slider->save();

        // Redirect or return a response
        return redirect()->route('sliders.index')->with('success', 'Slider updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
         // Find the slider by its ID
         $slider = Slider::find($id);

         if (!$slider) {
             return redirect()->route('sliders.index')->with('error', 'Slider not found.');
         }
 
         // Get the image file name to be deleted
         $imageToDelete = $slider->slider_image;
 
         // Remove the image file from storage
         if (!empty($imageToDelete) && File::exists(public_path('images/sliders/' . $imageToDelete))) {
             File::delete(public_path('images/sliders/' . $imageToDelete));
         }
 
         // Delete the slider record from the database
         $slider->delete();
 
         // Redirect or return a response
         return redirect()->route('sliders.index')->with('success', 'Slider deleted successfully.');
    }
}

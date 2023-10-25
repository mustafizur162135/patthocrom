<?php

namespace App\Http\Controllers\Backend\setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\SettingNamController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;
//use Image;

class SettingController extends Controller
{
    
    public function showForm($id = null)
{
    // Check if an ID is provided and load the existing setting
    if ($id) {
        $setting = Setting::findOrFail($id);
    } else {
        // No ID provided, create a new setting instance
        $setting = new Setting();
    }

    $bannerImages = json_decode($setting->banner_images);
    return view('backend.setting.form', compact('setting','bannerImages'));
}

// public function storeOrUpdate(Request $request)
// {
//     $id = $request->input('id');
//     $operation = $id ? 'update' : 'create';

//     // Validate the request data, if needed

//     // Create or update the setting based on the input data
//     if ($operation === 'create') {
//         Setting::create($request->all());
//     } elseif ($operation === 'update') {
//         $setting = Setting::findOrFail($id);
//         $setting->update($request->all());
//     }

//     // Redirect back with success or error messages
//     return back()->with('success', 'Setting ' . ($operation === 'create' ? 'created' : 'updated') . ' successfully.');
// }




public function storeOrUpdate(Request $request)
{
    $id = $request->input('id');
    $operation = $id ? 'update' : 'create';

    // Validate the request data
    $rules = [
        'mail' => 'required',
        'contact_no' => 'required',
        'fb_link' => 'required',
        'youtube_link' => 'required',
        'address' => 'required',
        'about_us' => 'required',
        'logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Add logo validation rules
        'banner_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        'about_us_image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
    ];

    $request->validate($rules);

    // Create or update the setting based on the input data
    if ($operation === 'create') {
        $setting = new Setting($request->except('logo', 'banner_image', 'about_us_image'));

        // Handle logo upload and resize
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('images/setting/');
            $logo->move($destinationPath, $logoName);

            // Resize the image
            $image = Image::make($destinationPath . $logoName);
            $image->resize(150, 56); // Resize to the desired dimensions
            $image->save(); // Save the resized image
            $setting->logo = $logoName;
        }
        // Handle banner_image upload and resize
        if ($request->hasFile('banner_image')) {
            $banner_image = $request->file('banner_image');
            $banner_imageName = time() . '_banner.' . $banner_image->getClientOriginalExtension();
            $destinationPath = public_path('images/setting/banner/');
            $banner_image->move($destinationPath, $banner_imageName);

            // Resize the image
            $banner_image = Image::make($destinationPath . $banner_imageName);
            $banner_image->resize(1920, 729); // Resize to the desired dimensions
            $banner_image->save(); // Save the resized image
            $setting->banner_image = $banner_imageName;
        }
        // Handle about_us_image upload and resize
        if ($request->hasFile('about_us_image')) {
            $about_us_image = $request->file('about_us_image');
            $about_us_imageName = time() . '_about_us.' . $about_us_image->getClientOriginalExtension();
            $destinationPath = public_path('images/setting/');
            $about_us_image->move($destinationPath, $about_us_imageName);

            // Resize the image
            $about_us_image = Image::make($destinationPath . $about_us_imageName);
            $about_us_image->resize(676, 442); // Resize to the desired dimensions
            $about_us_image->save(); // Save the resized image
            $setting->about_us_image = $about_us_imageName;
        }

            $setting->save();
        } elseif ($operation === 'update') {
            $setting = Setting::findOrFail($id);
        
            // Handle logo update
            if ($request->hasFile('logo')) {
                // Delete the previous logo if it exists
                $previousImage = public_path('images/setting/') . $setting->logo;
                if (file_exists($previousImage) && is_file($previousImage)) {
                    unlink($previousImage);
                }
        
                // Handle the new logo
                $logo = $request->file('logo');
                $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
                $destinationPath = public_path('images/setting/');
                $logo->move($destinationPath, $logoName);
        
                // Resize the logo
                $image = Image::make($destinationPath . $logoName);
                $image->resize(180, 56); // Resize to the desired dimensions
                $image->save(); // Save the resized image
        
                // Update the logo field in the setting model
                $setting->logo = $logoName;
            }
        
            // Handle banner_image update
            if ($request->hasFile('banner_image')) {
                // Delete the previous banner_image if it exists
                $previousBannerImage = public_path('images/setting/banner/') . $setting->banner_image;
                if (file_exists($previousBannerImage) && is_file($previousBannerImage)) {
                    unlink($previousBannerImage);
                }
        
                // Handle the new banner_image
                $bannerImage = $request->file('banner_image');
                $bannerImageName = time() . '_banner.' . $bannerImage->getClientOriginalExtension();
                $destinationPath = public_path('images/setting/banner/');
                $bannerImage->move($destinationPath, $bannerImageName);
        
                // Resize the banner_image if needed
                // Add code here to resize or process the banner_image if required
                
                $image = Image::make($destinationPath . $bannerImageName);
                $image->resize(1920, 729); // Adjust dimensions as needed
                $image->save(); // Save the resized image

                // Update the banner_image field in the setting model
                $setting->banner_image = $bannerImageName;
            }
        
            // Handle about_us_image update (similar to banner_image)
            if ($request->hasFile('about_us_image')) {
                // Delete the previous about_us_image if it exists
                $previousAboutUsImage = public_path('images/setting/') . $setting->about_us_image;
                if (file_exists($previousAboutUsImage) && is_file($previousAboutUsImage)) {
                    unlink($previousAboutUsImage);
                }
        
                // Handle the new about_us_image
                $aboutUsImage = $request->file('about_us_image');
                $aboutUsImageName = time() . '_about_us.' . $aboutUsImage->getClientOriginalExtension();
                $destinationPath = public_path('images/setting/');
                $aboutUsImage->move($destinationPath, $aboutUsImageName);
        
                // Resize the about_us_image if needed
                // Add code here to resize or process the about_us_image if required
        
                $image = Image::make($destinationPath . $aboutUsImageName);
                $image->resize(676, 442); // Adjust dimensions as needed
                $image->save(); // Save the resized image

                // Update the about_us_image field in the setting model
                $setting->about_us_image = $aboutUsImageName;
            }
        
            // Update other fields (excluding 'logo', 'banner_image', and 'about_us_image') in the setting model
            $setting->fill($request->except('logo', 'banner_image', 'about_us_image'));
            $setting->save();
        
            // Redirect back with success or error messages
            return back()->with('success', 'Setting updated successfully.');
        }
        

}


}

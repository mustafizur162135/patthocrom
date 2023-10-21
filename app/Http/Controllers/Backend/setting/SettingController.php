<?php

namespace App\Http\Controllers\Backend\setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\SettingNamController;
use App\Http\Requests\SettingRequest;
use App\Models\Setting;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    private $SettingNamApiController;

    public function __construct(SettingNamController $SettingNamApiController)
    {
        $this->SettingNamApiController = $SettingNamApiController;
    }

    public function create(){
        
        try {
            $subjectName = $this->SettingNamApiController->create();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        if (!($subjectName instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $subjectName is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        //$classes = collect($subjectName->getData()->classes);
        $status = $subjectName->getData()->status;
        $message = $subjectName->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }

        return view('backend.setting.form');
    }

    public function store(Request $request)
    {

        // return $request;
        $setting = new SettingRequest([
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
            'mail' => $request->input('mail'),
            'about_us' => $request->input('about_us'),
            'fb_link' => $request->input('fb_link'),
            'youtube_link' => $request->input('youtube_link')
        ]);

        try {
            $apiResponse = $this->SettingNamApiController->store($setting);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to create settingName.');
        } 
        catch (\Exception $e) {
            return back()->with('error', 'Failed to create settingName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create settingName.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Class created successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to create settingName.');
        } else {
            return back()->with('error', 'Failed to create settingName.');
        }
    }


    public function edit($id)
    {

        try {
            $apiResponse = $this->SettingNamApiController->edit($id);
           
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve subjectName.');
        }
        if (!($apiResponse instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $apiResponse is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve subjectName.');
        }

        //$classes = collect($apiResponse->getData()->classes);

         $setting = $apiResponse->getData()->setting;
        
        $status = $apiResponse->getData()->status;
        $message = $apiResponse->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }
        return view('backend.setting.form', compact('setting'));
    }

    public function update(Request $request,$id)
    {
        

        $setting = new SettingRequest([
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
            'mail' => $request->input('mail'),
            'about_us' => $request->input('about_us'),
            'fb_link' => $request->input('fb_link'),
            'youtube_link' => $request->input('youtube_link')
        ]);


        try {
            $apiResponse = $this->SettingNamApiController->update($setting,$id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to update settingName.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update settingName.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update settingName.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Class updated successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to updateclassName.');
        } else {
            return back()->with('error', 'Failed to updateclassName.');
        }
    }

    public function showForm($id = null)
{
    // Check if an ID is provided and load the existing setting
    if ($id) {
        $setting = Setting::findOrFail($id);
    } else {
        // No ID provided, create a new setting instance
        $setting = new Setting();
    }

    return view('backend.setting.form', compact('setting'));
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
    ];

    $request->validate($rules);

    // Create or update the setting based on the input data
    if ($operation === 'create') {
        $setting = new Setting($request->except('logo'));

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('images/');
            $logo->move($destinationPath, $logoName);
            $setting->logo = $logoName;
        }

        $setting->save();
    } elseif ($operation === 'update') {
        $setting = Setting::findOrFail($id);

        // Handle logo update
        if ($request->hasFile('logo')) {
            // Delete the previous image
            $previousImage = public_path('images/') . $setting->logo;
            if (file_exists($previousImage)) {
                unlink($previousImage);
            }

            $logo = $request->file('logo');
            $logoName = time() . '.' . $logo->getClientOriginalExtension();
            $destinationPath = public_path('images/');
            $logo->move($destinationPath, $logoName);
            $setting->logo = $logoName;
        }

        // Update other fields
        $setting->fill($request->except('logo'));
        $setting->save();
    }

    // Redirect back with success or error messages
    return back()->with('success', 'Setting ' . ($operation === 'create' ? 'created' : 'updated') . ' successfully.');
}







}

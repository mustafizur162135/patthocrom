<?php

namespace App\Http\Controllers\Backend\setting;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\SettingNamController;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;

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

    public function showForm(Request $request,$id = null)
{
    if ($id) {
        try {
            $apiResponse = $this->SettingNamApiController->edit($id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve setting data.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve setting data.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve setting data.');
        }

        if (!($apiResponse instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $apiResponse is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve setting data.');
        }

        $setting = $apiResponse->getData()->setting;
        $status = $apiResponse->getData()->status;
        $message = $apiResponse->getData()->message;

        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }
    } else {
        // Create a new Setting instance when no ID is provided.
        //$setting = new Setting();

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
    

    return view('backend.setting.form', compact('setting'));
}



    
public function storeOrUpdate(Request $request)
{
    $id = $request->input('id');
    $operation = $id ? 'update' : 'create';

    // Add validation logic here

    if ($operation === 'create') {
        // Create a new setting
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
            return back()->with('error', 'Failed to create setting.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create setting.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create setting.');
        }
    } elseif ($operation === 'update') {
        // Update an existing setting
        $setting = new SettingRequest([
            'address' => $request->input('address'),
            'contact_no' => $request->input('contact_no'),
            'mail' => $request->input('mail'),
            'about_us' => $request->input('about_us'),
            'fb_link' => $request->input('fb_link'),
            'youtube_link' => $request->input('youtube_link')
        ]);

        try {
            $apiResponse = $this->SettingNamApiController->update($setting, $id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to update setting.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update setting.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update setting.');
        }
    }

    if ($apiResponse->getStatusCode() === 200) {
        return back()->with('success', 'Setting ' . ($operation === 'create' ? 'created' : 'updated') . ' successfully.');
    } elseif ($apiResponse->getStatusCode() === 500) {
        return back()->with('error', 'Failed to ' . ($operation === 'create' ? 'create' : 'update') . ' setting.');
    } else {
        return back()->with('error', 'Failed to ' . ($operation === 'create' ? 'create' : 'update') . ' setting.');
    }
}


}

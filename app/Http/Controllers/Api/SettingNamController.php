<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SettingRequest;
use App\Models\Classname;
use App\Models\Setting;
use App\Models\Subject;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SettingNamController extends Controller
{
    

    public function create()
    {
        try {
            //$classes = Classname::get();
           
            return response()->json([
                'status' => 200,
                'message' => 'This is the create function for SesstingNameController'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
            'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    
    public function store(SettingRequest $request)
    {
        try {
             // Process Data
        $setting = Setting::create([
            'address' => $request->input('address'),
                'contact_no' => $request->input('contact_no'),
                'mail' => $request->input('mail'),
                'about_us' => $request->input('about_us'),
                'fb_link' => $request->input('fb_link'),
                'youtube_link' => $request->input('youtube_link')
        
        ]);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        

            return response()->json([
                'message' => 'setting created successfully',
                'setting' => $setting
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    
    public function show(Request $request, $id)
    {
        $subject = Subject::find($id);
        if (!$subject) {
            return response()->json([
                'message' => 'subjectname not found'
            ], 404);
        }
        return response()->json([
            'message' => 'This is the show function for subjectnameController',
            'subject' => $subject
        ]);
    }
    
    public function update(SettingRequest $request, $id)
    {
        // try {
            // Retrieve the class based on the provided $id
            $setting = Setting::find($id);
    
            if (!$setting) {
                return response()->json([
                    'message' => 'Setting not found'
                ], 404);
            }
    
            // Update the setting attributes with data from the request
            $setting->update([
                'address' => $request->input('address'),
                'contact_no' => $request->input('contact_no'),
                'mail' => $request->input('mail'),
                'about_us' => $request->input('about_us'),
                'fb_link' => $request->input('fb_link'),
                'youtube_link' => $request->input('youtube_link')
            ]);
    
            
            // Save the changes to the database
            $setting->save();
    
            return response()->json([
                'message' => 'Setting updated successfully !!',
                'setting' => $setting
            ]);
        // } catch (\Throwable $th) {
        //     return response()->json([
        //         'message' => 'Error updating class name',
        //         'error' => $th->getMessage()
        //     ], 500);
        // }
    }
    

    public function edit($id)
    {
        try {
            $setting = Setting::find($id);
            if (!$setting) {
                return response()->json([
                    'message' => 'setting not found',
                    'status' => 404
                ], 404);
            }
            
            $classes = Classname::all();
    
            return response()->json([
                'message' => 'setting found',
                'setting' => $setting,
                'status' => 200
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error finding role',
                'error' => $th->getMessage(),
                'status' => 500
            ], 500);
        }
    }
    
    
    
    public function delete($id)
    {
        try {
            $subject = Subject::find($id);
            if (!$subject) {
                return response()->json([
                    'message' => 'subject not found'
                ], 404);
            }

            $subject->delete();
            
            return response()->json([
                'message' => 'subject revoked successfully',
                'subject' => $subject
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating class and revoking permission',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}


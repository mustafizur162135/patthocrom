<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubjectNameRequest;
use App\Models\Classname;
use App\Models\Subject;
use Illuminate\Http\Request;
use Mockery\Matcher\Subset;

class SubjectNamController extends Controller
{
    public function index()
    {
        try {
            $subjects = Subject::get();
    
            if ($subjects->isEmpty()) {
                // Handle the case when there are no roles found.
                return response()->json([
                    'status' => 404,
                    'message' => 'No subjects found.',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'This is the index function for subjectNameController',
                'subjects' => $subjects
            ]);
        } catch (\Exception $e) {
            // Handle any other unexpected errors.
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function create()
    {
        try {
            $classes = Classname::get();
           
            return response()->json([
                'status' => 200,
                'message' => 'This is the create function for SubjectNameController',
                'classes' => $classes
            ]);
        } catch (\Throwable $th) {
            return response()->json([
            'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    

    public function store(SubjectNameRequest $request)
    {
        try {
             // Process Data
        $subject = Subject::create([
            'class_id' => $request->class_id, 
            'sub_name' => $request->sub_name, 
            'sub_code' => $request->sub_code, 
            'sub_note' => $request->sub_note
        
        ]);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        

            return response()->json([
                'message' => 'Subject created successfully',
                'subject' => $subject
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
    
    public function update(SubjectNameRequest $request, $id)
    {
        try {
            // Retrieve the class based on the provided $id
            $subject = Subject::find($id);
    
            if (!$subject) {
                return response()->json([
                    'message' => 'subject not found'
                ], 404);
            }
    
            // Update the subject attributes with data from the request
            $subject->update([
                'class_id' => $request->input('class_id'),
                'sub_name' => $request->input('sub_name'),
                'sub_code' => $request->input('sub_code'),
                'sub_note' => $request->input('sub_note'),
            ]);
    
            // Save the changes to the database
            $subject->save();
    
            return response()->json([
                'message' => 'subject updated successfully !!',
                'subject' => $subject
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating class name',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    

    public function edit($id)
    {
        try {
            $subject = Subject::find($id);
            if (!$subject) {
                return response()->json([
                    'message' => 'subject not found',
                    'status' => 404
                ], 404);
            }
            
            $classes = Classname::all();
    
            return response()->json([
                'message' => 'subject found',
                'subject' => $subject,
                'classes' => $classes, // Include the "classes" data
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


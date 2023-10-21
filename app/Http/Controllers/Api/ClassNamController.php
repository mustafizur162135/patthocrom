<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassNameRequest;
use App\Models\Classname;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ClassNamController extends Controller
{
    public function index()
    {
        try {
            $classes = Classname::get();
    
            if ($classes->isEmpty()) {
                // Handle the case when there are no roles found.
                return response()->json([
                    'status' => 404,
                    'message' => 'No className found.',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'This is the index function for ClassNameController',
                'classes' => $classes
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
            //$permissions = Permission::get();
           
            return response()->json([
                'status' => 200,
                'message' => 'This is the create function for ClassNameController'
            ]);
        } catch (\Throwable $th) {
            return response()->json([
            'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    

    public function store(ClassNameRequest $request)
    {
        try {
             // Process Data
        $class = Classname::create([
            'class_name' => $request->class_name, 
            'class_code' => $request->class_code, 
            'class_note' => $request->class_note
        
        ]);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        

            return response()->json([
                'message' => 'className created successfully',
                'class' => $class
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }
    
    public function show(ClassNameRequest $request, $id)
    {
        $class = Classname::find($id);
        if (!$class) {
            return response()->json([
                'message' => 'Classname not found'
            ], 404);
        }
        return response()->json([
            'message' => 'This is the show function for ClassnameController',
            'class' => $class
        ]);
    }
    
    public function update(ClassNameRequest $request, $id)
    {
        try {
            // Retrieve the class based on the provided $id
            $class = Classname::find($id);
    
            if (!$class) {
                return response()->json([
                    'message' => 'Class not found'
                ], 404);
            }
    
            // Update the class attributes with data from the request
            $class->update([
                'class_name' => $request->input('class_name'),
                'class_code' => $request->input('class_code'),
                'class_note' => $request->input('class_note'),
            ]);
    
            // Save the changes to the database
            $class->save();
    
            return response()->json([
                'message' => 'Class updated successfully !!',
                'class' => $class
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
            $class = Classname::find($id);
            if (!$class) {
                return response()->json([
                    'message' => 'class not found',
                    'status' => 404
                ], 404);
            }
            
            return response()->json([
                'message' => 'class found',
                'class' => $class,
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
    
    public function destroy(ClassNameRequest $request, $id)
    {
        try {
            $class = Classname::find($id);
            if (!$class) {
                return response()->json([
                    'message' => 'class not found'
                ], 404);
            }
            
            return response()->json([
                'message' => 'class revoked successfully',
                'class' => $class
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating class and revoking permission',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}


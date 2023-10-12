<?php

namespace App\Http\Controllers\Backend\role;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\RolePermissionController;
use App\Http\Requests\RolePermissionRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;


class RoleController extends Controller
{

    private $rolePermissionApiController;

    public function __construct(RolePermissionController $rolePermissionApiController)
    {
        $this->rolePermissionApiController = $rolePermissionApiController;
    }
    public function index()
    {
        // ...

        try {
            $rolePermission = $this->rolePermissionApiController->index();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        }

        if (!($rolePermission instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $rolePermission is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        }

        $roles = collect($rolePermission->getData()->roles);
        $status = $rolePermission->getData()->status;
        $message = $rolePermission->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        }

        // This is my api how to get value
        $roles = $roles->map(function ($role) {
            return [
                'id' => $role->id,
                'name' => $role->name,
                'permissions' => collect($role->permissions)->pluck('name')->toArray(),
            ];
        });


        return view('backend.roles.index',compact('roles'));



       
    }

    public function create(){
        
        try {
            $rolePermission = $this->rolePermissionApiController->create();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        }

        if (!($rolePermission instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $rolePermission is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles and permissions.');
        }

         $permissions = collect($rolePermission->getData()->permissions);
        $status = $rolePermission->getData()->status;
        $message = $rolePermission->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }

        return view('backend.roles.form', compact('permissions'));
    }


    public function store(Request $request)
    {

        // return $request;
        $rolePermission = new RolePermissionRequest([
            'role' => $request->input('name'),
            'permissions' => $request->input('permissions'),
        ]);

        try {
            $apiResponse = $this->rolePermissionApiController->store($rolePermission);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to create role and associate permission.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to create role and associate permission.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to create role and associate permission.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Role created and permission associated successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to create role and associate permission.');
        } else {
            return back()->with('error', 'Failed to create role and associate permission.');
        }
    }


    public function edit($id)
    {

        try {
            $apiResponse = $this->rolePermissionApiController->edit($id);
           
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve role and permissions.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve role and permissions.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve role and permissions.');
        }
        if (!($apiResponse instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $apiResponse is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve role and permissions.');
        }
        $permissions = collect($apiResponse->getData()->permissions);
         $role = $apiResponse->getData()->role;
        
        $status = $apiResponse->getData()->status;
        $message = $apiResponse->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }
        return view('backend.roles.form', compact('permissions', 'role'));
    }

    public function update(Request $request,$id)
    {
        

        $rolePermission = new RolePermissionRequest([
            'role' => $request->input('name'),
            'permissions' => $request->input('permissions'),
        ]);

        try {
            $apiResponse = $this->rolePermissionApiController->update($rolePermission,$id);
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to update role and associate permission.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to update role and associate permission.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to update role and associate permission.');
        }


        if ($apiResponse->getStatusCode() === 200) {
            return back()->with('success', 'Role updated and permission associated successfully.');
        } elseif ($apiResponse->getStatusCode() === 500) {
            return back()->with('error', 'Failed to update role and associate permission.');
        } else {
            return back()->with('error', 'Failed to update role and associate permission.');
        }
    }
}

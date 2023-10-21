<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\RolePermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index()
    {
        try {
            $roles = Role::with('permissions')->get();
    
            if ($roles->isEmpty()) {
                // Handle the case when there are no roles found.
                return response()->json([
                    'status' => 404,
                    'message' => 'No roles found.',
                ], 404);
            }
    
            return response()->json([
                'status' => 200,
                'message' => 'This is the index function for RolePermissionController',
                'roles' => $roles
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
            $permissions = Permission::get();
           
            return response()->json([
                'status' => 200,
                'message' => 'This is the create function for RolePermissionController',
                'permissions' => $permissions
            ]);
        } catch (\Throwable $th) {
            return response()->json([
            'status' => 500,
                'message' => 'An error occurred while processing your request.',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    

    public function store(RolePermissionRequest $request)
    {
        try {
             // Process Data
        $role = Role::create(['name' => $request->role, 'guard_name' => 'admin']);

        // $role = DB::table('roles')->where('name', $request->name)->first();
        $permissions = $request->input('permissions');

        if (!empty($permissions)) {
            $role->syncPermissions($permissions);
        }
            return response()->json([
                'message' => 'Role created and permission associated successfully',
                'role' => $role,
                'permission' => $permissions
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
        $role = Role::with('permissions')->find($id);
        if (!$role) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }
        return response()->json([
            'message' => 'This is the show function for RolePermissionController',
            'role' => $role
        ]);
    }
    
    public function update(Request $request, $id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return response()->json([
                    'message' => 'Role not found'
                ], 404);
            }
            if ($role->guard_name === 'admin') {
                return response()->json([
                    'message' => 'Cannot update admin role'
                ], 403);
            }
            $permission = Permission::findByName($request->permission);
            $role->syncPermissions([$permission]);
            return response()->json([
                'message' => 'Role updated and permission associated successfully',
                'role' => $role,
                'permission' => $permission
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating role and associating permission',
                'error' => $th->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        try {
            $role = Role::with('permissions')->find($id);
            if (!$role) {
                return response()->json([
                    'message' => 'Role not found',
                    'status' => 404
                ], 404);
            }
            $permissions = Permission::all();
            return response()->json([
                'message' => 'Role found',
                'role' => $role,
                'permissions' => $permissions,
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
    
    public function destroy(Request $request, $id)
    {
        try {
            $role = Role::find($id);
            if (!$role) {
                return response()->json([
                    'message' => 'Role not found'
                ], 404);
            }
            if ($role->guard_name === 'admin') {
                return response()->json([
                    'message' => 'Cannot delete admin role'
                ], 403);
            }
            $permission = Permission::findByName($request->permission);
            $role->revokePermissionTo($permission);
            return response()->json([
                'message' => 'Role updated and permission revoked successfully',
                'role' => $role,
                'permission' => $permission
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error updating role and revoking permission',
                'error' => $th->getMessage()
            ], 500);
        }
    }
}


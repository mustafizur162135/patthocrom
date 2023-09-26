<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionController extends Controller
{
    public function index(Request $request)
    {
        $roles = Role::with('permissions')->get();
        return response()->json([
            'message' => 'This is the index function for RolePermissionController',
            'roles' => $roles
        ]);
    }

    public function store(Request $request)
    {
        try {
            $permission = Permission::findByName($request->permission);
            $role = Role::create(['name' => $request->role]);
            $role->givePermissionTo($permission);
            return response()->json([
                'message' => 'Role created and permission associated successfully',
                'role' => $role,
                'permission' => $permission
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                'message' => 'Error creating role and associating permission',
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


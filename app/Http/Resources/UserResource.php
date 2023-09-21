<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Helpers\Helper;

class UserResource extends JsonResource
{
    public function toArray($request)
    {
        $data = [
            'user_id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'token'     => $this->createToken("Token")->plainTextToken,
            'guard' =>  Helper::activeGuard(),
            'roles' => [],
            'roles_permissions' => [],
            'permissions' => [],
        ];


        // Check the guard name and populate roles and permissions accordingly
        if (Auth::guard('admin')) {
            $data['roles'] = $this->roles->pluck('name')->toArray();
            $data['roles_permissions'] = $this->getPermissionsViaRoles()->pluck('name')->toArray();
            $data['permissions'] = $this->permissions->pluck('name')->toArray();
        } elseif (Auth::guard('student')) {
            // Populate roles and permissions for 'student' guard
            // Adjust this section as needed for 'student' guard
            $data['roles'] = $this->roles->pluck('name')->toArray();
            $data['roles_permissions'] = $this->getPermissionsViaRoles()->pluck('name')->toArray();
            $data['permissions'] = $this->permissions->pluck('name')->toArray();
        } elseif (Auth::guard('teacher')) {
            // Populate roles and permissions for 'teacher' guard
            // Adjust this section as needed for 'teacher' guard
            $data['roles'] = $this->roles->pluck('name')->toArray();
            $data['roles_permissions'] = $this->getPermissionsViaRoles()->pluck('name')->toArray();
            $data['permissions'] = $this->permissions->pluck('name')->toArray();
        }

        return $data;
    }


}

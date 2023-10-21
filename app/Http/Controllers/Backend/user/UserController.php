<?php

namespace App\Http\Controllers\Backend\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\LoginController;
use App\Http\Requests\RegisterRequest;
use App\Models\Admin;;

use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public $user;

    private $loginApiController;

    public function __construct(LoginController $loginApiController)
    {
        $this->loginApiController = $loginApiController;
        $this->middleware(function ($request, $next) {
            $this->user = Auth::guard('admin')->user();
            return $next($request);
        });
    }


    public function index()
    {


        if (is_null($this->user) || !$this->user->can('admin.users.view')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }


        try {
            $admins = $this->loginApiController->index();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles and admins.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles and admins.');
        }

        if (!($admins instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $admins is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles and admins.');
        }


        $responseData = $admins->getData();

        //    dd($responseData);
        if (property_exists($responseData, 'admins')) {
            $all_admin = collect($responseData->admins);

            $all_admin = collect($admins->getData()->admins);
            $status = $admins->getData()->status;
            $message = $admins->getData()->message;
            if ($status == 404) {
                return back()->with('error', $message);
            }

            // This is my api how to get value
            $all_admins = $all_admin->map(function ($all_admin) {
                return [
                    'id' => $all_admin->id,
                    'name' => $all_admin->name,
                    'email' => $all_admin->email,
                    'role' => $all_admin->roles[0]->name ?? ''
                ];
            });
            // dd($all_admins);
            return view('backend.users.index', compact('all_admins'));
        } else {
            // Data doesn't exist or the property is not present.
            echo "Data not found";
        }
    }



    public function create()
    {

        if (is_null($this->user) || !$this->user->can('admin.users.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        try {
            $role = $this->loginApiController->create();
        } catch (HttpResponseException $e) {
            return back()->with('error', 'Failed to retrieve roles.');
        } catch (\Exception $e) {
            return back()->with('error', 'Failed to retrieve roles.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Failed to retrieve roles.');
        }

        if (!($role instanceof \Illuminate\Http\JsonResponse)) {
            // Handle the case where $rolePermission is not an instance of JsonResponse
            return back()->with('error', 'Failed to retrieve roles.');
        }

        $status = $role->getData()->status;
        $all_role = $role->getData()->roles;
        $message = $role->getData()->message;
        if ($status == 404) {
            return back()->with('error', $message);
        } elseif ($status == 500) {
            return back()->with('error', $message);
        }

        return view('backend.users.form', compact('all_role'));
    }


    public function store(Request $request)
    {


        if (is_null($this->user) || !$this->user->can('admin.users.create')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        // Validation Data
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|max:100|email|unique:admins',
            'password' => 'required|min:6|confirmed',
        ]);

        // Create New Admin
        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->password = Hash::make($request->password);
        $admin->save();

        if ($request->role) {
            $admin->assignRole($request->role);
        }

        session()->flash('success', 'Admin has been created !!');
        return back();
    }

    public function edit($id)
    {

        if (is_null($this->user) || !$this->user->can('admin.users.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $user = Admin::find($id);

    
        $all_role = Role::where('guard_name', 'admin')->get();

        return view('backend.users.form', compact('user','all_role'));
    }

    public function update(Request $request,$id)
    {

        if (is_null($this->user) || !$this->user->can('admin.users.update')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

          // Create New Admin
          $admin = Admin::find($id);

          // Validation Data
          $request->validate([
              'name' => 'required|max:50',
              'email' => 'required|max:100|email|unique:admins,email,' . $id,
              'password' => 'nullable|min:6|confirmed',
          ]);
  
  
          $admin->name = $request->name;
          $admin->email = $request->email;
          if ($request->password) {
              $admin->password = Hash::make($request->password);
          }
          $admin->save();
  
          $admin->roles()->detach();
          if ($request->role) {
              $admin->assignRole($request->role);
          }
  
          session()->flash('success', 'Admin has been updated !!');
          return back();

    }

    public function delete($id)
    {

        if (is_null($this->user) || !$this->user->can('admin.users.delete')) {
            abort(403, 'Sorry !! You are Unauthorized to view any admin !');
        }

        $admin = Admin::find($id);
        if (!is_null($admin)) {
            $admin->delete();
        }

        session()->flash('success', 'Admin has been deleted !!');
        return back();

    }
}

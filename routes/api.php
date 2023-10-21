<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController,
    RegisterController,
    StudentController,
    TeacherController,
    RolePermissionController
};
use App\Http\Resources\UserResource;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/admin', function (Request $request) {
//     return new UserResource($request->user());
// });


// Route::middleware(['auth:sanctum', 'abilities :admin'])->get('/admin', function (Request $request) {
//     return new UserResource($request->user());
// });

// Admin Route Group
Route::middleware(['auth:sanctum', 'can:view-admin-panel', 'abilities:admin'])->group(function () {
    
    // Admin Dashboard or Profile Route
    Route::get('/admin', function (Request $request) {
        return new UserResource($request->user());
    });

 

// Role Permission Route
Route::get('/role-permission', [RolePermissionController::class, 'index'])->name('api.role-permission.index');
Route::post('/role-permission-store', [RolePermissionController::class, 'store'])->name('api.role-permission.store');

    
    // Logout Route
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    
    // Add other admin routes here if needed
    
});

// Student Route
Route::middleware(['auth:sanctum', 'can:view-student-panel','abilities :admin'])->get('/student', function (Request $request) {
    return new UserResource($request->user());
});

// Teacher Route
Route::middleware(['auth:sanctum', 'can:view-teacher-panel','abilities :admin'])->get('/teacher', function (Request $request) {
    return new UserResource($request->user());
});


Route::post('admin/login', [LoginController::class, 'login'])->name('admin.login');
Route::post('admin/register', [RegisterController::class, 'register'])->name('admin.register');

Route::post('student/login', [StudentController::class, 'login'])->name('student.login');
Route::post('student/register', [StudentController::class, 'register'])->name('student.register');

Route::post('teacher/login', [TeacherController::class, 'login'])->name('teacher.login');
Route::post('teacher/register', [TeacherController::class, 'register'])->name('teacher.register');


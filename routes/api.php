<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\{
    LoginController,
    RegisterController,
    StudentController,
    TeacherController
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

// Admin Route
Route::middleware(['auth:sanctum', 'can:view-admin-panel','abilities :admin'])->get('/admin', function (Request $request) {
    return new UserResource($request->user());
});

// Student Route
Route::middleware(['auth:sanctum', 'can:view-student-panel','abilities :admin'])->get('/student', function (Request $request) {
    return new UserResource($request->user());
});

// Teacher Route
Route::middleware(['auth:sanctum', 'can:view-teacher-panel','abilities :admin'])->get('/teacher', function (Request $request) {
    return new UserResource($request->user());
});


Route::post('admin/login',[LoginController::class,'login'])->name('api.route');
Route::post('admin/register',[RegisterController::class,'register']);

Route::post('student/login',[StudentController::class,'login']);
Route::post('student/register',[StudentController::class,'register']);

Route::post('teacher/login',[TeacherController::class,'login']);
Route::post('teacher/register',[TeacherController::class,'register']);


<?php

use App\Http\Controllers\Backend\{
    AdminDashboardController,
    AdminLoginController
};
use App\Http\Controllers\Backend\role\RoleController;
use App\Http\Controllers\Backend\teacher\{
    TeacherDashboardController,
    TeacherLoginController
};

use App\Http\Controllers\Backend\student\{
    StudentDashboardController,
    StudentLoginController
};


// Rest of your code...
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => ['auth.admin']], function () {
    Route::get('/admin/dashboard', AdminDashboardController::class)->name('admin.dashboard');
    Route::post('register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin');


    Route::get('role', [RoleController::class, 'index'])->name('admin.role');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('role/{id}/update', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('role/{id}/delete', [RoleController::class, 'delete'])->name('admin.roles.delete');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.roles.store');
    

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['middleware' => ['auth.teacher']], function () {
    Route::get('/teacher/dashboard', TeacherDashboardController::class)->name('teacher.dashboard');
});

Route::group(['middleware' => ['auth.student']], function () {
    Route::get('/student/dashboard', StudentDashboardController::class)->name('student.dashboard');
});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/loginSubmit', [AdminLoginController::class, 'adminLogin'])->name('admin.login');

Route::get('teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login.form');
Route::post('teacher/loginSubmit', [TeacherLoginController::class, 'teacherLogin'])->name('teacher.login');

Route::get('student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login.form');
Route::post('student/loginSubmit', [StudentLoginController::class, 'studentLogin'])->name('student.login');

Route::post('register/teacher', [TeacherLoginController::class, 'registerTeacher'])->name('register.teacher');
Route::post('register/student', [StudentLoginController::class, 'registerStudent'])->name('register.student');


<?php

// frontend part start

use App\Http\Controllers\Frontend\{
   HomeController
};

// frontend part end


use App\Http\Controllers\Backend\{
    AdminDashboardController,
    AdminLoginController,
    SliderController
};
use App\Http\Controllers\Backend\role\RoleController;
use App\Http\Controllers\Backend\class\ClassnameController;
use App\Http\Controllers\Backend\subject\SubjectController;
use App\Http\Controllers\Backend\setting\SettingController;
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

// Frontend part start

    Route::get('/', [HomeController::class, 'home'])->name('home');
    Route::get('/course', [HomeController::class, 'course'])->name('course');

// Frontend part end

Route::group(['middleware' => ['auth.admin']], function () {
    Route::get('/admin/dashboard', AdminDashboardController::class)->name('admin.dashboard');
    Route::post('register/admin', [RegisterController::class, 'registerAdmin'])->name('register.admin');

// role
    Route::get('role', [RoleController::class, 'index'])->name('admin.role');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.roles.create');
    Route::get('role/{id}/edit', [RoleController::class, 'edit'])->name('admin.roles.edit');
    Route::put('role/{id}/update', [RoleController::class, 'update'])->name('admin.roles.update');
    Route::delete('role/{id}/delete', [RoleController::class, 'delete'])->name('admin.roles.delete');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.roles.store');

    // class

    Route::get('admin/class', [ClassnameController::class, 'index'])->name('admin.class');
    Route::get('admin/class/create', [ClassnameController::class, 'create'])->name('admin.class.create');
    Route::get('admin/class/{id}/edit', [ClassnameController::class, 'edit'])->name('admin.class.edit');
    Route::put('admin/class/{id}/update', [ClassnameController::class, 'update'])->name('admin.class.update');
    Route::delete('admin/class/{id}/delete', [ClassnameController::class, 'delete'])->name('admin.class.delete');
    Route::post('admin/class/store', [ClassnameController::class, 'store'])->name('admin.class.store');

    // subject

    Route::get('admin/subject', [SubjectController::class, 'index'])->name('admin.subject');
    Route::get('admin/subject/create', [SubjectController::class, 'create'])->name('admin.subject.create');
    Route::get('admin/subject/{id}/edit', [SubjectController::class, 'edit'])->name('admin.subject.edit');
    Route::put('admin/subject/{id}/update', [SubjectController::class, 'update'])->name('admin.subject.update');
    Route::delete('admin/subject/{id}/delete', [SubjectController::class, 'delete'])->name('admin.subject.delete');
    Route::post('admin/subject/store', [SubjectController::class, 'store'])->name('admin.subject.store');

    // setting

    Route::get('admin/setting/form/{id?}', [SettingController::class, 'showForm'])->name('admin.setting.form');

    Route::match(['put', 'patch'], 'admin/setting/storeOrUpdate', [SettingController::class, 'storeOrUpdate'])->name('admin.setting.storeOrUpdate');

    // slider

    Route::resource('sliders', SliderController::class);


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

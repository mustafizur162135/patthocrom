
<?php

// frontend part start

use App\Http\Controllers\Frontend\{
    HomeController
 };
 
 // frontend part end
 
 

use App\Http\Controllers\Backend\{
    AdminDashboardController,
    AdminLoginController
};
use App\Http\Controllers\Backend\role\RoleController;
use App\Http\Controllers\Backend\class\ClassnameController;
use App\Http\Controllers\Backend\question\ImportController;
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
use App\Http\Controllers\Backend\user\UserController;
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


    //user

    Route::get('user', [UserController::class, 'index'])->name('admin.user');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('user/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('user/{id}/delete', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.users.store');



     // class

     Route::get('class', [ClassnameController::class, 'index'])->name('admin.class');
     Route::get('class/create', [ClassnameController::class, 'create'])->name('admin.class.create');
     Route::get('class/{id}/edit', [ClassnameController::class, 'edit'])->name('admin.class.edit');
     Route::put('class/{id}/update', [ClassnameController::class, 'update'])->name('admin.class.update');
     Route::delete('class/{id}/delete', [ClassnameController::class, 'delete'])->name('admin.class.delete');
     Route::post('class/store', [ClassnameController::class, 'store'])->name('admin.class.store');
 
     // subject
 
     Route::get('subject', [SubjectController::class, 'index'])->name('admin.subject');
     Route::get('subject/create', [SubjectController::class, 'create'])->name('admin.subject.create');
     Route::get('subject/{id}/edit', [SubjectController::class, 'edit'])->name('admin.subject.edit');
     Route::put('subject/{id}/update', [SubjectController::class, 'update'])->name('admin.subject.update');
     Route::delete('subject/{id}/delete', [SubjectController::class, 'delete'])->name('admin.subject.delete');
     Route::post('subject/store', [SubjectController::class, 'store'])->name('admin.subject.store');

    //  for question
     Route::resource('question_types', QuestionTypeController::class);
     Route::post('import', [ImportController::class, 'import'])->name('question.import.route');
     Route::get('import_form', [ImportController::class, 'showForm'])->name('question.import.form');
     Route::get('download-sample-excel', [ImportController::class, 'downloadSampleExcel'])->name('download.sample.excel');


    

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['middleware' => ['auth.teacher']], function () {
    Route::get('/teacher/dashboard', TeacherDashboardController::class)->name('teacher.dashboard');
});

Route::group(['middleware' => ['auth.student']], function () {
    Route::get('/student/dashboard', StudentDashboardController::class)->name('student.dashboard');
});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/loginSubmit', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login.form');
Route::post('teacher/loginSubmit', [TeacherLoginController::class, 'teacherLogin'])->name('teacher.login.submit');

Route::get('student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login.form');
Route::post('student/loginSubmit', [StudentLoginController::class, 'studentLogin'])->name('student.login.submit');

Route::post('register/teacher', [TeacherLoginController::class, 'registerTeacher'])->name('register.teacher');
Route::post('register/student', [StudentLoginController::class, 'registerStudent'])->name('register.student');

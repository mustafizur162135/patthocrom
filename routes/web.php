
<?php

// frontend part start

use App\Http\Controllers\Backend\AdminDashboardController;
use App\Http\Controllers\Backend\AdminLoginController;
// frontend part end

use App\Http\Controllers\Backend\class\ClassnameController;
use App\Http\Controllers\Backend\exam\Exam_questionController;
use App\Http\Controllers\Backend\exam\ExamController;
use App\Http\Controllers\Backend\note\NoteController;
use App\Http\Controllers\Backend\note\StudentNoteController;
use App\Http\Controllers\Backend\question\ImportController;
use App\Http\Controllers\Backend\question\QuestionsController;
use App\Http\Controllers\Backend\role\RoleController;
use App\Http\Controllers\Backend\setting\SettingController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\student\StudentDashboardController;
use App\Http\Controllers\Backend\student\StudentLoginController;
use App\Http\Controllers\Backend\student_exam\StudentExamController;
use App\Http\Controllers\Backend\studentpackage\StudentPackageController;
use App\Http\Controllers\Backend\subject\SubjectController;
use App\Http\Controllers\Backend\teacher\TeacherDashboardController;
use App\Http\Controllers\Backend\teacher\TeacherLoginController;
use App\Http\Controllers\Backend\user\UserController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\HomeController;
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
Route::get('/allCourse', [HomeController::class, 'course'])->name('allcourse');
Route::get('/package/{id}', [HomeController::class, 'showSinglePackage'])->name('package.show');
Route::post('/studentCheckout', [CheckoutController::class, 'studentCheckout'])->name('student.checkout');
Route::post('/studentCheckoutProcess', [CheckoutController::class, 'studentCheckoutProcess'])->name('student.checkout.process');
Route::get('student/checkout/confirmation', [CheckoutController::class, 'studentCheckoutConfirmation'])->name('student.checkout.confirmation');

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
    Route::get('admin/course', [ClassnameController::class, 'index'])->name('admin.class');
    Route::get('admin/course/create', [ClassnameController::class, 'create'])->name('admin.class.create');
    Route::get('admin/course/{id}/edit', [ClassnameController::class, 'edit'])->name('admin.class.edit');
    Route::put('admin/course/{id}/update', [ClassnameController::class, 'update'])->name('admin.class.update');
    Route::delete('admin/course/{id}/delete', [ClassnameController::class, 'delete'])->name('admin.class.delete');
    Route::post('admin/course/store', [ClassnameController::class, 'store'])->name('admin.class.store');

    Route::get('user', [UserController::class, 'index'])->name('admin.user');
    Route::get('user/create', [UserController::class, 'create'])->name('admin.users.create');
    Route::get('user/{id}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
    Route::put('user/{id}/update', [UserController::class, 'update'])->name('admin.users.update');
    Route::delete('user/{id}/delete', [UserController::class, 'delete'])->name('admin.users.delete');
    Route::post('user/store', [UserController::class, 'store'])->name('admin.users.store');

    // slider

    Route::resource('sliders', SliderController::class);

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
    Route::resource('questions', QuestionsController::class);
    Route::post('import', [ImportController::class, 'import'])->name('question.import.route');
    Route::get('import_form', [ImportController::class, 'showForm'])->name('question.import.form');
    Route::get('download-sample-excel', [ImportController::class, 'downloadSampleExcel'])->name('download.sample.excel');

    Route::post('ckeditor/upload', [QuestionsController::class, 'upload'])->name('ckeditor.upload');

    // exam

    Route::resource('exams', ExamController::class);
    Route::resource('exam_question', Exam_questionController::class);
    Route::resource('studentpackages', StudentPackageController::class);

    //note

    Route::get('/notes', [NoteController::class, 'index'])->name('notes.index');
    Route::get('/notes/create', [NoteController::class, 'create'])->name('notes.create');
    Route::post('/notes', [NoteController::class, 'store'])->name('notes.store');

    // New routes for edit, update, and delete
    Route::get('/notes/{id}/edit', [NoteController::class, 'edit'])->name('notes.edit');
    Route::put('/notes/{id}', [NoteController::class, 'update'])->name('notes.update');
    Route::delete('/notes/{id}', [NoteController::class, 'destroy'])->name('notes.destroy');

    //setting

    Route::get('admin/setting/form/{id?}', [SettingController::class, 'showForm'])->name('admin.setting.form');

    Route::match(['put', 'patch'], 'admin/setting/storeOrUpdate', [SettingController::class, 'storeOrUpdate'])->name('admin.setting.storeOrUpdate');

    Route::post('logout', [AdminLoginController::class, 'logout'])->name('admin.logout');
});

Route::group(['middleware' => ['auth.teacher']], function () {
    Route::get('/teacher/dashboard', TeacherDashboardController::class)->name('teacher.dashboard');
});

Route::group(['middleware' => ['auth.student']], function () {
    Route::get('/student/dashboard', StudentDashboardController::class)->name('student.dashboard');

    Route::get('student_exam', [StudentExamController::class, 'index'])->name('student.student_exam');
    Route::get('student_exam_question/{id}', [StudentExamController::class, 'student_exam_question'])->name('student.student_exam_question');
    Route::post('submit_answers', [StudentExamController::class, 'submit_answers'])->name('submit.answers');

    Route::get('/get-question/{examId}/{questionIndex}', [StudentExamController::class, 'getQuestion']);

    Route::get('student_note', [StudentNoteController::class, 'index'])->name('student.student_note');

    Route::get('/student/buy-package-list', [StudentPackageController::class, 'studentBuyPackageList'])->name('student.buy-package-list');


});

Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/loginSubmit', [AdminLoginController::class, 'adminLogin'])->name('admin.login.submit');

Route::get('teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login.form');
Route::post('teacher/loginSubmit', [TeacherLoginController::class, 'teacherLogin'])->name('teacher.login.submit');

Route::get('student/login', [StudentLoginController::class, 'showLoginForm'])->name('student.login.form');
Route::post('student/loginSubmit', [StudentLoginController::class, 'studentLogin'])->name('student.login.submit');

Route::post('register/teacher', [TeacherLoginController::class, 'registerTeacher'])->name('register.teacher');
Route::post('register/student', [StudentLoginController::class, 'registerStudent'])->name('register.student');

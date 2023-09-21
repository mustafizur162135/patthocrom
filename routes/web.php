<?php


use App\Http\Controllers\Backend\{
    AdminDashboardController,
    AdminLoginController
};
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

Route::middleware(['auth:admin'])->get('/admin/dashboard', AdminDashboardController::class)->name('admin.dashboard');



Route::get('admin/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login.form');
Route::post('admin/loginSubmit', [AdminLoginController::class, 'login'])->name('admin.login');

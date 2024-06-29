<?php

use App\Http\Middleware\PreventBackHistoryMiddleware;
use Illuminate\Support\Facades\Route;

// ========== Backend
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\HomeController;
use App\Http\Controllers\Backend\PackageTypeController;
use App\Http\Controllers\Backend\PackageController;
use App\Http\Controllers\Backend\AdminController;

// ========== Frontend
use App\Http\Controllers\Frontend\Auth\RegisterController AS CitizenRegisterController;
use App\Http\Controllers\Frontend\Auth\LoginController AS CitizenLoginController;
use App\Http\Controllers\Frontend\HomeController AS CitizenHomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/', function () {
    return redirect()->route('citizen.login');
})->name('/');


Route::group(['prefix' => 'admin'],function(){
    // ======================= Admin Register
    Route::get('register', [RegisterController::class, 'register'])->name('admin.register');
    Route::post('register/store', [RegisterController::class, 'store'])->name('admin.register.store');

    // ======================= Admin Login/Logout
    Route::get('login', [LoginController::class, 'login'])->name('admin.login');
    Route::post('login/store', [LoginController::class, 'authenticate'])->name('admin.login.store');
    Route::post('logout', [LoginController::class, 'logout'])->name('admin.logout');
});


// ======================= Admin Dashboard
Route::group(['prefix' => 'admin','middleware' => ['auth:web', PreventBackHistoryMiddleware::class]], function () {

    // ===== Admin Dashboard
    Route::get('dashboard', [HomeController::class, 'Admin_Home'])->name('admin.dashboard');

    // ==== Update Password
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('admin.change-password');
    Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('admin.update-password');

    // ==== Manage Package Type
    Route::resource('package-type', PackageTypeController::class);

    // ==== Manage Package
    Route::resource('package', PackageController::class);

    // ==== Manage Admin
    Route::resource('admin', AdminController::class);

    // ==== Manage Citizen
    // Route::resource('citizen', CitizenController::class);

});

Route::group(['prefix' => 'citizen'],function(){
    // ======================= Citizens Register
    Route::get('register', [CitizenRegisterController::class, 'Citizen_Register_Form'])->name('citizen.register');
    Route::post('register/store', [CitizenRegisterController::class, 'Citizen_Store_Register'])->name('citizen.register.store');

    // ======================= Citizens Login/Logout
    Route::get('login', [CitizenLoginController::class, 'Citizen_Login_Form'])->name('citizen.login');
    Route::post('login/store', [CitizenLoginController::class, 'Citizen_Authenticate'])->name('citizen.login.store');
    Route::post('logout', [CitizenLoginController::class, 'Citizen_Logout'])->name('citizen.logout');
});

// ======================= Citizens Dashboard
Route::group(['prefix' => 'citizen','middleware' => ['auth:citizen', PreventBackHistoryMiddleware::class]], function () {

    // ===== Citizen Dashboard
    Route::get('dashboard', [CitizenHomeController::class, 'Citizen_Home'])->name('citizen.dashboard');

    // ==== Update Password
    Route::get('/change-password', [CitizenHomeController::class, 'changePassword'])->name('citizen.change-password');
    Route::post('/change-password', [CitizenHomeController::class, 'updatePassword'])->name('citizen.update-password');

});

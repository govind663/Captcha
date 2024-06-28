<?php

use App\Http\Middleware\PreventBackHistoryMiddleware;
use Illuminate\Support\Facades\Route;

// ========== Backend
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\HomeController;

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
    return redirect()->route('login');
})->name('/');


Route::group(['prefix' => 'admin'],function(){
    // ======================= Admin Register
    Route::get('register', [RegisterController::class, 'register'])->name('register');
    Route::post('register/store', [RegisterController::class, 'store'])->name('register.store');

    // ======================= Admin Login/Logout
    Route::get('login', [LoginController::class, 'login'])->name('login');
    Route::post('login/store', [LoginController::class, 'authenticate'])->name('login.store');
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});


// ======================= Admin Dashboard
Route::group(['prefix' => 'admin','middleware' => ['auth:web', PreventBackHistoryMiddleware::class]], function () {

    // ===== Admin Dashboard
    Route::get('dashboard', [HomeController::class, 'Admin_Home'])->name('dashboard');

    // ==== Update Password
    Route::get('/change-password', [HomeController::class, 'changePassword'])->name('change-password');
    Route::post('/change-password', [HomeController::class, 'updatePassword'])->name('update-password');


});

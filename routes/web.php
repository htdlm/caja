<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\{
    ClientController,
    DashboardController,
    UsersController,
};

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
    return redirect('login');
})->name('landing');

// Auth Routes - Login
Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'access']);
Route::get('logout', [AuthController::class, 'logout'])->name('logout');

// Auth Routes - Register
Route::get('register', [AuthController::class, 'register'])->name('register');
Route::post('register', [AuthController::class, 'create']);

// Protected routes
Route::group(['middleware' => 'auth'], function () {

    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users
    Route::resource('users', UsersController::class);
    // Clients
    Route::resource('clients', ClientController::class);

    Route::post('file-import', [ClientController::class, 'fileImport'])->name('file-import');
    Route::get('file-export', [ClientController::class, 'fileExport'])->name('file-export');
});

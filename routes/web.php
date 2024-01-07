<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use Illuminate\Support\Facades\Route;

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

Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index')->middleware('auth:cms');

Route::get('/admin/login', [LoginController::class, 'showLoginForm'])->name('admin.login.show');

Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.login.check');

Route::get('/', function () {
    return to_route('admin.dashboard.index');
});

// Auth::routes();
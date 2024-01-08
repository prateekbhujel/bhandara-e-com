<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\ProfileController;
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

Route::post('/admin/logout', [LoginController::class, 'logout'])->name('admin.logout');

Route::get('/admin/profile/edit', [ProfileController::class, 'edit'])->name('admin.profile.edit');

Route::match(['put', 'patch'], '/admin/profile/update', [ProfileController::class, 'update'])->name('admin.profile.update');

Route::get('/', function () {
    return to_route('admin.dashboard.index');
});

// Auth::routes();
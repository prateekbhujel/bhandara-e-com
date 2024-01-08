<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffsController;
use Illuminate\Support\Facades\Route;

/** 
 * Web Routes for Admin Section. 
*/
Route::prefix('admin')->name('admin.')->group(function() {
    
    //Auth 'CMS' middleware group start.
    Route::middleware('auth:cms')->group(function() {
        
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
        
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
        
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
        
        Route::match(['put', 'patch'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
        
        Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
        
        Route::match(['put', 'patch'], '/password/update', [PasswordController::class, 'update'])->name('password.update');

        Route::resource('staffs', StaffsController::class)->except(['show']);
        
    });//End Middleware group.
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login.check');

});//End Admin Routes Group.


Route::get('/', function () {
    return to_route('admin.dashboard.index');
});

// Auth::routes();
<?php

use App\Http\Controllers\Admin\BrandsController;
use App\Http\Controllers\Admin\CategoriesController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\PasswordController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\StaffsController;
use App\Http\Controllers\Admin\UsersController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\PagesController;
use Illuminate\Support\Facades\Route;

/** 
 * Web Routes for Admin Section. 
*/
Route::prefix('admin')->name('admin.')->group(function() {
    
    //Auth 'CMS' middleware group start.
    Route::middleware('auth:cms')->group(function() {
        
        Route::middleware('active-only')->group(function() {

            Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');

            Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
            
            Route::match(['put', 'patch'], '/profile/update', [ProfileController::class, 'update'])->name('profile.update');
            
            Route::get('/password/edit', [PasswordController::class, 'edit'])->name('password.edit');
            
            Route::match(['put', 'patch'], '/password/update', [PasswordController::class, 'update'])->name('password.update');

            Route::resource('staffs', StaffsController::class)->except(['show'])->middleware('admin-access');

            Route::resources([
                'categories' => CategoriesController::class,  
                'brands'     => BrandsController::class, 
                'products'   => ProductsController::class,
                'users'   => UsersController::class,
            ], [
                'except'     => ['show']
            ]);

            Route::delete('/products/{product}/image/{filename}', [ProductsController::class, 'image'])->name('products.image');

        });

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

        Route::get('/inactive', function() {
            return view('admin.errors.inactive');
        })->name('errros.inactive');
        
    });//End Middleware group.
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login.show');

    Route::post('/login', [LoginController::class, 'login'])->name('login.check');

});//End Admin Routes Group.


//Front Page Routes
Route::name('front.')->group(function(){
   
    Route::controller(CartController::class)->group(function() {
        Route::get('/cart', 'index')->name('cart.index');
        Route::post('/cart/{product}/{qty}', 'store')->name('cart.store');
        Route::match(['put', 'patch'], '/cart/update', 'update')->name('cart.update');
        Route::get('/cart/total', 'total')->name('cart.total');
        Route::get('cart/{product}/destroy', 'destroy')->name('cart.destroy');
        Route::get('/checkout', 'checkout')->name('cart.checkout')->middleware('auth');
    });

    Route::controller(PagesController::class)->group(function() {
        Route::get('/category/{category}', 'category')->name('pages.category');
        Route::get('/brand/{brand}', 'brand')->name('pages.brand');
        Route::get('/product/{product}', 'product')->name('pages.product');
        Route::post('/product/{product}/review', 'review')->name('pages.review')->middleware('auth');
        Route::get('/search', 'search')->name('pages.search');
        Route::get('/','index')->name('pages.index');
        
    });
});//End of Front Page Rout

Auth::routes();
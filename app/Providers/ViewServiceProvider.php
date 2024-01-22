<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //

    }//End Metnhod

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        
        View::composer(['admin.products.create', 'admin.products.edit', 'front.templates.nav'], function($view) {
            $categories = Category::whereStatus('Active')->select('id', 'name')->get();
            $brands = Brand::whereStatus('Active')->select('id', 'name')->get();

            $view->with(compact('categories', 'brands'));

        });

    }//End Metnhod
}

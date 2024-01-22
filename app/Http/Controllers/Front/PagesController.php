<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class PagesController extends Controller
{
   
    public function index()
    {
        $featured = Product::whereStatus('Active')->whereFeatured('Yes')->take(4)->inRandomOrder()->get();
        $latest = Product::whereStatus('Active')->take(4)->latest()->get();
        
        return view('front.pages.index', compact('featured', 'latest'));

    } //End Method

    public function category(Category $category)
    {
        $products = $category->products()->whereStatus('Active')->paginate(24);
        
        return view('front.pages.category', compact('category', 'products'));

    }//End Method

    public function brand(Brand $brand)
    {
        $products = $brand->products()->whereStatus('Active')->paginate(24);
        
        return view('front.pages.brand', compact('brand', 'products'));

    }//End Method

    public function search(Request $request)
    {
        $products = Product::whereStatus('Active')->where('name', 'like', '%' . $request->term . '%')->paginate(24);

        return view('front.pages.search', compact('products'));

    }//End Method
}

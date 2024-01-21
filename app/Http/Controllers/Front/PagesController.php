<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
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
}

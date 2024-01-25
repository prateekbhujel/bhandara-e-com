<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use Auth;
use Illuminate\Http\Request;

class PagesController extends Controller
{
   
    public function index()
    {
        $featured   = Product::whereStatus('Active')->whereFeatured('Yes')->take(4)->inRandomOrder()->get();
        $latest     = Product::whereStatus('Active')->take(4)->latest()->get();
        $topSelling = Product::whereStatus('Active')->withCount('order_details')->take(4)
                            ->orderBy('order_details_count', 'desc')->get();
        
        return view('front.pages.index', compact('featured', 'latest', 'topSelling'));

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
        $products = Product::whereStatus('Active')->where(function($query) use ($request) {
            $query->where('name','like', '%' . $request->term . '%')
                  ->orWhereHas('category', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->term . '%');
                })->orWherehas('brand', function($query) use ($request) {
                    $query->where('name', 'like', '%' . $request->term . '%');
                });
        })->paginate(24);

        return view('front.pages.search', compact('products'));

    }//End Method

    public function product(Product $product)
    {
        $similars = Product::whereStatus('Active')->where('id', '!=', $product->id)
                            ->whereCategoryId($product->category_id)
                            ->take(4)->inRandomOrder()->get();

        return view('front.pages.product' , compact('product' , 'similars'));

    }//End Method

    public function review(Request $req, $id)
    {

        $validated = $req->validate([
            'content' => 'required|string',
            'rating'  => 'required|numeric|min:1|max:5',
        ]);

        $validated['product_id'] = $id;
        $validated['user_id']    = Auth::id();

        Review::create($validated);

        return redirect()->back()->withSuccess('Thank You For Your Rating and Review.');
    }//End Method
}

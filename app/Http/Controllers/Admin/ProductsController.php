<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager as Image;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);

        return view('admin.products.index', compact('products'));

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'             => 'required|string',
            'summary'          => 'required|string',
            'details'          => 'required|string',
            'price'            => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'category_id'      => 'required|exists:categories,id',
            'brand_id'         => 'required|exists:brands,id',
            'images'           => 'required|array',
            'images.*'         => 'required|image',
        ]);

        $images =[];
        foreach($request->images as $image) {

            $filename = "img".date('YmdHis').rand(1000, 9999). ".".$image->extension();

            $img = (new Image(new Driver))->read($image);
            
            $img->scaleDown(1280, 720)->save(storage_path("app/public/images/$filename"));
            
            $images[] = $filename;

        }

        $validated['images'] = $images;

        Product::create($validated);

        return to_route('admin.products.index')->with('success', 'Product created.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //

    }//End Method

    public function image(Product $product, string $filename)
    {
        if(count($product->images) > 1)
        {
            @unlink(storage_path("images/$filename"));

            $images = array_diff($product->images, [$filename]);

            $product->update(['images' => $images]);

            return response('Ok')->with('','');
        }else
        {

        }

    }//End Method
}

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
            'status'           => 'required|in:Active,Inactive',
            'featured'         => 'required|in:Yes,No',
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
        $validated =  $request->validate([
            'name'             => 'required|string',
            'summary'          => 'required|string',
            'details'          => 'required|string',
            'price'            => 'required|numeric',
            'discounted_price' => 'nullable|numeric',
            'category_id'      => 'required|exists:categories,id',
            'brand_id'         => 'required|exists:brands,id',
            'images'           => 'nullable|array',
            'images.*'         => 'nullable|image',
            'status'           => 'required|in:Active,Inactive',
            'featured'         => 'required|in:Yes,No',
        ]);
        
        $images = $product->images;
        if($request->hasFile('images')) {
            foreach($request->images as $image) {
                $filename = "img" . date('YmdHis') . rand(1000, 9999) . "." .$image->extension();

                $img = (new Image(new Driver))->read($image);

                $img->scaleDown(1280, 720)->save(storage_path("app/public/images/$filename"));

                $images[] = $filename;
            }
        }

        $validated['images'] = $images;

        $product->update($validated);

        return to_route('admin.products.index')->with('success', 'Product Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        foreach($product->images as $image) {
            @unlink(storage_path("app/public/images/$image"));
        }

        $product->delete();

        return to_route('admin.products.index')->with('success', 'Product Removed.');

    }//End Method

    public function image(Product $product, string $filename)
    {
        if(count($product->images) > 1)
        {
            @unlink(storage_path("images/$filename"));

            $images = array_values(array_diff($product->images, [$filename]));

            $product->update(['images' => $images]);

            return response(['success' => 'Image Removed']);

        }else
        {
            return response(['error' => 'At least one image is required.'], 400);
        }

    }//End Method
}

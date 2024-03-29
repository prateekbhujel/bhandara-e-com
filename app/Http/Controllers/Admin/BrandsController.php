<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class BrandsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::paginate(10);
        
        if(request()->wantsJson()) 
        {
            return $brands;
        }

        return view('admin.brands.index', compact('brands'));

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brands.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Brand::create($request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required|in:Active,Inactive'
        ]));
                
        if(request()->wantsJson()) 
        {
            return response(['success' =>'Brand created.']);
        }

        return to_route('admin.brands.index')->with('success', 'Brand added.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Brand $brand)
    {
        return view('admin.brands.edit', compact('brand'));

    }//End Method

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Brand $brand)
    {
        $brand->update($request->validate([
            'name' => ['required', Rule::unique('brands', 'name')->whereNot('name', $brand->name)],
            'status' => 'required|in:Active,Inactive'
        ]));

        if($request->wantsJson()) 
        {
            return response(['success' => 'Brand Updated.']);
        }

        return to_route('admin.brands.index')->with('success', 'Brand updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Brand $brand)
    {
        $brand->delete();

        if($request->wantsJson())
        {
            return response(['success' => "Brand Deleted."]);
        }

        return to_route('admin.brands.index')->with('success', 'Brand deleted.');

    }//End Method
}

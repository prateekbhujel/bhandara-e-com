<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::paginate(10);

        return view ('admin.categories.index', compact('categories'));

    }//End Method

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');

    }//End Method

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Category::create($request->validate([
            'name' => 'required|unique:categories,name',
            'status' => 'required|in:Active,Inactive'
        ]));

        return to_route('admin.categories.index')->with('success', 'Category added.');

    }//End Method

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {

        return view('admin.categories.edit', compact('category'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->validate([
            'name' => 'required',
            'status' => 'required|in:Active,Inactive'
        ]));

        return to_route('admin.categories.index')->with('success', 'Category updated.');

    }//End Method

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return to_route('admin.categories.index')->with('success', 'Category deleted.');

    }//End Method
}

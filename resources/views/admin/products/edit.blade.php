@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-5 mx-auto">
                    <h1>
                        Edit Product
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.products.update', [$product->id]) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('patch')

                    <div class="col-5 mx-auto">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $product->name) }}" required>
                        </div>                        

                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea name="summary" id="summary" class="editor" required> {{ old('summary', $product->summary) }} </textarea>
                        </div>

                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="editor" required> {{ old('summary', $product->details) }}</textarea>
                        </div>
                        
                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price', $product->price) }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="discounted_price" class="form-label">Discounted Price</label>
                            <input type="number" name="discounted_price" id="discounted_price" class="form-control" value="{{ old('discounted_price', $product->discounted_price) }}" step="0.01">
                        </div> 

                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple>
                        </div>

                        <div class="row mt-3" id="img-container"></div>

                        <div class="row">
                            @foreach($product->images as $image)
                            <div class="col-4 mt-3">
                                <div class="row">
                                    <div class="col-12">
                                        <img src="{{ url("public/storage/images/$image") }}" class="img-fluid">
                                    </div>
                                    <div class="col-12 mt-3 text-center">
                                        <button type="button" class="btn btn-danger btn-sm img-delete" data-id="{{ $product->id }}" data-file="{{ $image }}">
                                            <i class="fa-solid fa-times me-2"></i>Delete
                                        </button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="mb-3">
                            <label for="product">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}" @selected($brand->id == $product->brand_id)>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active" @selected($product->status == 'Active')>Active</option>
                                <option value="Inactive" @selected($product->status == 'Inactive')>Inactive</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label for="featured" class="form-label">Featured</label>
                            <select name="featured" id="featured" class="form-select" required>
                                <option value="Yes" @selected($product->featured == 'Yes')>Yes</option>
                                <option value="No" @selected($product->featured == 'No')>No</option>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <button type="submit" class="btn btn-dark btn-sm">
                                <i class="fa-solid fa-save me-2"></i>Save
                            </button>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
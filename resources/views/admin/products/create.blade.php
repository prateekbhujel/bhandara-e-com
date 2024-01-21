@extends('layouts.admin')

@section('title', 'Add Product')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col-8 mx-auto">
                    <h1>
                        Add Product
                    </h1>
                </div>
            </div>
            <div class="row">
                <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
                    @csrf

                    <div class="col-8 mx-auto">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="summary" class="form-label">Summary</label>
                            <textarea name="summary" id="summary" class="editor" required>{{ old('summary') }}</textarea>
                        </div>                        
                        
                        <div class="mb-3">
                            <label for="details" class="form-label">Details</label>
                            <textarea name="details" id="details" class="editor" required>{{ old('details') }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price</label>
                            <input type="number" name="price" id="price" class="form-control" value="{{ old('price') }}" step="0.01" required>
                        </div>

                        <div class="mb-3">
                            <label for="discounted_price" class="form-label">Discounted Price</label>
                            <input type="number" name="discounted_price" id="discounted_price" class="form-control" value="{{ old('discounted_price') }}" step="0.01">
                        </div>

                        <div class="mb-3">
                            <label for="images" class="form-label">Images</label>
                            <input type="file" name="images[]" id="images" class="form-control" accept="image/*" multiple required>
                        </div>
                        
                        <div class="row mt-3" id="img-container"></div>

                        <div class="mb-3">
                            <label for="product">Category</label>
                            <select name="category_id" id="category_id" class="form-select" required>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="brand">Brand</label>
                            <select name="brand_id" id="brand_id" class="form-select" required>
                                @foreach ($brands as $brand)
                                    <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select name="status" id="status" class="form-select" required>
                                <option value="Active">Active</option>
                                <option value="Inactive">Inactive</option>
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
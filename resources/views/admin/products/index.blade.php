@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Products
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.products.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Product
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($products->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->status }}</td>
                                        <td>{{ $product->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $product->updated_at->toDayDateTimeString() }}</td>
                                        <td>
                                            <form action="{{ route('admin.products.destroy', [$product->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.products.edit', [$product->id]) }}" class="btn btn-dark btn-sm">
                                                    <i class="fa-solid fa-edit me-2"></i>Edit
                                                </a>
                                                <button type="submit" class="btn btn-danger btn-sm delete">
                                                    <i class="fa-solid fa-times me-2"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
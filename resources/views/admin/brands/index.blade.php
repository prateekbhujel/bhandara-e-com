@extends('layouts.admin')

@section('title', 'Brands')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Brands
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.brands.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Brand
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($brands->isNotEmpty())
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
                                @foreach ($brands as $brand)
                                    <tr>
                                        <td>{{ $brand->name }}</td>
                                        <td>{{ $brand->status }}</td>
                                        <td>{{ $brand->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $brand->updated_at->toDayDateTimeString() }}</td>
                                        <td>
                                            <form action="{{ route('admin.brands.destroy', [$brand->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.brands.edit', [$brand->id]) }}" class="btn btn-dark btn-sm">
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
                        {{ $brands->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
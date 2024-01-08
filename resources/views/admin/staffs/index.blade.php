@extends('layouts.admin')

@section('title', 'Staffs')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Staffs
                    </h1>
                </div>
                <div class="col-auto">
                    <a href="{{ route('admin.staffs.create') }}" class="btn btn-dark">
                        <i class="fa-solid fa-plus me-2"></i>Add Staff
                    </a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($staffs->isNotEmpty())
                        <table class="table table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Address</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($staffs as $staff)
                                    <tr>
                                        <td>{{ $staff->name }}</td>
                                        <td>{{ $staff->email }}</td>
                                        <td>{{ $staff->phone }}</td>
                                        <td>{{ $staff->address }}</td>
                                        <td>{{ $staff->status }}</td>
                                        <td>{{ $staff->created_at->toDayDateTimeString() }}</td>
                                        <td>{{ $staff->updated_at->toDayDateTimeString() }}</td>
                                        <td>
                                            <form action="{{ route('admin.staffs.destroy', [$staff->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <a href="{{ route('admin.staffs.edit', [$staff->id]) }}" class="btn btn-dark btn-sm">
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
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
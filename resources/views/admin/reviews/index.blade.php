@extends('layouts.admin')

@section('title', 'Reviews')


@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Reviews
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($reviews->isNotEmpty())
                        <table class="table table-responsive table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Product Name</th>
                                    <th>User</th>
                                    <th>Comment</th>
                                    <th>Rating</th>
                                    <th>Reviewd At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <td>{{ $review->product->name }}</td>
                                        <td>{{ $review->user->name }}</td>
                                        <td>{!! $review->content !!}</td>
                                        <td>{{ $review->rating }}<i class="fa-solid fa-star ms-2"></i></td>
                                        <td>{{ $review->created_at->format('j M Y, h:i A') }}</td>
                                        <td>
                                            <form action="{{ route('admin.reviews.destroy', [$review->id]) }}" method="post">
                                                @csrf
                                                @method('delete')
                                                <button type="submit" class="btn btn-danger btn-sm delete">
                                                    <i class="fa-solid fa-times me-2"></i>Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>   
                                @endforeach
                            </tbody>
                        </table>
                        {{ $reviews->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
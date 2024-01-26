@if ($reviews->isNotEmpty())
    <table class="table table-responsive table-striped table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th>Product Name</th>
                <th>Comment</th>
                <th>Rating</th>
                <th>Reviewd At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reviews as $review)
                <tr>
                    <td>{{ $review->product->name }}</td>
                    <td>{!! $review->content !!}</td>
                    <td>{{ $review->rating }}<i class="fa-solid fa-star ms-2"></i></td>
                    <td>{{ $review->created_at->format('j M Y, h:i A') }}</td>
                </tr>   
            @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-muted fst-italic">No reviews made yet.</h4>
@endif
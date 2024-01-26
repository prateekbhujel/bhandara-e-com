@if ($orders->isNotEmpty())
    <table class="table table-responsive table-striped table-hover table-sm">
        <thead class="table-dark">
            <tr>
                <th>Details</th>
                <th>Status</th>
                <th>Ordered At</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <td>
                        <ul>
                            @foreach($order->details as $detail)
                            <li>{{ $detail->qty }} X {{ $detail->product->name }} @ Rs. {{ number_format($detail->price) }} = Rs. {{ number_format($detail->total) }}</li>
                            @endforeach
                        </ul>
                    </td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->created_at->format('j M Y, h:i A') }}</td>
                </tr>   
            @endforeach
        </tbody>
    </table>
@else
    <h4 class="text-muted fst-italic">No Order made yet.</h4>
@endif
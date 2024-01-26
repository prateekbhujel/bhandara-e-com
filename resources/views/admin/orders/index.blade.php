@extends('layouts.admin')

@section('title', 'Orders')


@section('content')
    
<div class="container">
    <div class="row">
        <div class="col-12 bg-white py-3 rounded-3 shadow-sm my-3">
            <div class="row">
                <div class="col">
                    <h1>
                        Orders
                    </h1>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    @if ($orders->isNotEmpty())
                        <table class="table table-responsive table-striped table-hover table-sm">
                            <thead class="table-dark">
                                <tr>
                                    <th>Details</th>
                                    <th>User</th>
                                    <th>Status</th>
                                    <th>Ordered At</th>
                                    <th>Actions</th>
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
                                        <td>{{ $order->user->name }}</td>
                                        <td>
                                            <form action="{{ route('admin.orders.update', [$order->id]) }}" method="post" onchange="this.submit()">
                                                @csrf
                                                @method('patch')
                                                    <select name="status" id="status" class="form-select" required>
                                                        <option value="Processing" @selected($order->status == 'Processing')>Processing</option>
                                                        <option value="Confirmed"  @selected($order->status == 'Confirmed')>Confirmed</option>
                                                        <option value="Shipping"   @selected($order->status == 'Shipping')>Shipping</option>
                                                        <option value="Delivered"  @selected($order->status == 'Delivered')>Delivered</option>
                                                        <option value="Cancelled"  @selected($order->status == 'Cancelled')>Cancelled</option>
                                                    </select>
                                            </form>
                                        </td>
                                        <td>{{ $order->created_at->format('j M Y, h:i A') }}</td>
                                        <td>
                                            <form action="{{ route('admin.orders.destroy', [$order->id]) }}" method="post">
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
                        {{ $orders->links() }}
                    @else
                        <h4 class="text-muted fst-italic">No data added.</h4>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>    
@endsection
@extends('layouts.front')

@section('title', 'Shopping Cart')
    
@section('content')

    <div class="col-12">
        <!-- Main Content -->
        <div class="row">
            <div class="col-12 mt-3 text-center text-uppercase">
                <h2>Shopping Cart</h2>
            </div>
        </div>

        <main class="row">
            <div class="col-12 bg-white py-3 mb-3">
                <div class="row">
                    @if(!empty($cart))
                        <div class="col-lg-6 col-md-8 col-sm-10 mx-auto table-responsive">
                            <form class="row" action="{{ route('front.cart.update') }}" method="POST">
                                @csrf
                                @method('PATCH')

                                <div class="col-12">
                                    <table class="table table-striped table-hover table-sm">
                                        <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($cart as $id => $item)
                                            <tr>
                                                <td>
                                                    <img src="{{ url("public/storage/images/{$item['thumbnail']}") }}" class="img-fluid me-3">
                                                     {{ $item['name'] }}
                                                </td>
                                                <td>
                                                    Rs. {{ number_format($item['price']) }}
                                                </td>
                                                <td>
                                                    <input type="number" min="1" name="qty[{{ $id }}]" value="{{ $item['qty'] }}">
                                                </td>
                                                <td>
                                                    Rs. {{ number_format($item['total']) }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-link text-danger"><i class="fas fa-times"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr>
                                            <th colspan="3" class="text-right">Total</th>
                                            <th>Rs. {{ number_format($cart->sum('total')) }}</th>
                                            <th></th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </div>
                                <div class="col-12 text-right">
                                    <button class="btn btn-outline-secondary me-3" type="submit">Update</button>
                                    <a href="#" class="btn btn-outline-success">Checkout</a>
                                </div>
                            </form>
                        </div>
                    @else
                    <div class="col-12 text-center fst-italic text-muted">
                        <h4>Shopping Cart is Empty!</h4>
                    </div>
                    @endif
                </div>
            </div>

        </main>
        <!-- Main Content -->
    </div>

@endsection
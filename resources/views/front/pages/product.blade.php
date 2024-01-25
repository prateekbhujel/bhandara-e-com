@extends('layouts.front')

@section('title', "{$product->name} - {$product->category->name}")
    
@section('content')
<div class="col-12">
    <!-- Main Content -->
    <main class="row">
        <div class="col-12 bg-white py-3 my-3">
            <div class="row">

                <!-- Product Images -->
                <div class="col-lg-5 col-md-12 mb-3">
                    <div class="col-12 mb-3">
                        <div class="img-large border" style="background-image: url('{{ url("public/storage/images/{$product->thumbnail}") }}')"></div>
                    </div>
                    <div class="col-12">
                        <div class="row">
                            @foreach ($product->images as $image)
                            <div class="col-sm-2 col-3">
                                <div class="img-small border" style="background-image: url('{{ url("public/storage/images/{$image}") }}')" 
                                     data-src="{{ url("public/storage/images/{$image}") }}">
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- Product Images -->

                <!-- Product Info -->
                <div class="col-lg-5 col-md-9">
                    <div class="col-12 product-name large">
                            {{ $product->name }}
                        <small class="mt-2">By <a href="{{ route('front.pages.brand', [$product->brand->id]) }}">{{ $product->brand->name }}</a></small>
                        <small class="mt-1">Category: <a href="{{ route('front.pages.category', [$product->category->id]) }}">{{ $product->category->name }}</a></small>
                    </div>
                    <div class="col-12 px-0">
                        <hr>
                    </div>
                    <div class="col-12"> 
                            {!! $product->summary !!}
                    </div>
                </div>
                <!-- Product Info -->

                <!-- Sidebar -->
                <div class="col-lg-2 col-md-3 text-center">
                    <div class="col-12 sidebar h-100">
                        <div class="row">
                            <div class="col-12">
                            @if(!is_null($product->discounted_price))
                            <span class="detail-price">
                                Rs. {{ number_format($product->discounted_price) }}
                            </span>
                                <span class="detail-price-old">
                                    Rs. {{ number_format($product->discounted_price) }}
                            </span>
                            @else
                            <span class="detail-price">Rs. {{ number_format($product->price) }}</span>
                            @endif
                            </div>
                            <div class="col-xl-5 col-md-9 col-sm-3 col-5 mx-auto mt-3">
                                <div class="mb-3">
                                    <label for="qty">Quantity</label>
                                    <input type="number" id="qty" min="1" value="1" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-outline-dark add-to-cart" data-id="{{ $product->id }}" type="button"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                            </div>
                            <div class="col-12 mt-3">
                                <button class="btn btn-outline-secondary btn-sm" type="button"><i class="fas fa-heart me-2"></i>Add to wishlist</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sidebar -->

            </div>
        </div>

        <div class="col-12 mb-3 py-3 bg-white text-justify">
            <div class="row">

                <!-- Details -->
                <div class="col-md-7">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-12 text-uppercase">
                                <h2><u>Details</u></h2>
                            </div>
                            <div class="col-12" id="details">
                                {!! $product->details !!}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Details -->

                <!-- Ratings & Reviews -->
                <div class="col-md-5">
                    <div class="col-12 px-md-4 sidebar h-100">

                        <!-- Rating -->
                        <div class="row">
                            <div class="col-12 mt-md-0 mt-3 text-uppercase">
                                <h2><u>Ratings & Reviews</u></h2>
                            </div>
                            <div class="col-12">
                                <div class="row">
                                    <div class="col-sm-4 text-center">
                                        <div class="row">
                                            <div class="col-12 average-rating">
                                                4.1
                                            </div>
                                            <div class="col-12">
                                                of 100 reviews
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <ul class="rating-list mt-3">
                                            <li>
                                                <div class="progress">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 45%;" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100">45%</div>
                                                </div>
                                                <div class="rating-progress-label">
                                                    5<i class="fas fa-star ms-1"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="progress">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 30%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100">30%</div>
                                                </div>
                                                <div class="rating-progress-label">
                                                    4<i class="fas fa-star ms-1"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="progress">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 15%;" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100">15%</div>
                                                </div>
                                                <div class="rating-progress-label">
                                                    3<i class="fas fa-star ms-1"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="progress">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 7%;" aria-valuenow="7" aria-valuemin="0" aria-valuemax="100">7%</div>
                                                </div>
                                                <div class="rating-progress-label">
                                                    2<i class="fas fa-star ms-1"></i>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="progress">
                                                    <div class="progress-bar bg-dark" role="progressbar" style="width: 3%;" aria-valuenow="3" aria-valuemin="3" aria-valuemax="100">3%</div>
                                                </div>
                                                <div class="rating-progress-label">
                                                    1<i class="fas fa-star ms-1"></i>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Rating -->

                        <div class="row">
                            <div class="col-12 px-md-3 px-0">
                                <hr>
                            </div>
                        </div>

                        <!-- Add Review -->
                        <div class="row">
                            <div class="col-12">
                                <h4>Add Review</h4>
                            </div>
                            <div class="col-12">
                                @auth
                                    <form action="{{ route('front.pages.review', [$product->id]) }}" method="POST">
                                        @csrf

                                        <div class="mb-3">
                                            <textarea class="form-control" name="content" placeholder="Give your review">{{ old('content') }}</textarea>
                                        </div>
                                        <div class="mb-3">
                                            <div class="d-flex ratings justify-content-end flex-row-reverse">
                                                <input type="radio" value="5" name="rating" id="rating-5"><label
                                                    for="rating-5"></label>
                                                <input type="radio" value="4" name="rating" id="rating-4"><label
                                                    for="rating-4"></label>
                                                <input type="radio" value="3" name="rating" id="rating-3"><label
                                                    for="rating-3"></label>
                                                <input type="radio" value="2" name="rating" id="rating-2"><label
                                                    for="rating-2"></label>
                                                <input type="radio" value="1" name="rating" id="rating-1" checked><label
                                                    for="rating-1"></label>
                                            </div>
                                        </div>
                                        <div class="mb-3">
                                            <button class="btn btn-outline-dark">Add Review</button>
                                        </div>
                                    </form>
                                @else
                                    <h6 class="text-muted fst-italic"> Please <a class="text-decoration-none" href="{{ route('login') }}">Log In </a>to add Your Review in ths prdouct.</h6>
                                @endif
                            </div>
                        </div>
                        <!-- Add Review -->

                        <div class="row">
                            <div class="col-12 px-md-3 px-0">
                                <hr>
                            </div>
                        </div>

                        <!-- Review -->
                        <div class="row">
                            <div class="col-12">

                                <!-- Comments -->
                                <div class="col-12 text-justify py-2 px-3 mb-3 bg-gray">
                                    <div class="row">
                                        <div class="col-12">
                                            <strong class="me-2">Steve Rogers</strong>
                                            <small>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut ullamcorper quam, non congue odio.
                                            <br>
                                            Fusce ligula augue, faucibus sed neque non, auctor rhoncus enim. Sed nec molestie turpis. Nullam accumsan porttitor rutrum. Curabitur eleifend venenatis volutpat.
                                            <br>
                                            Aenean faucibus posuere vehicula.
                                        </div>
                                        <div class="col-12">
                                            <small>
                                                <i class="fas fa-clock me-2"></i>5 hours ago
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comments -->

                                <!-- Comments -->
                                <div class="col-12 text-justify py-2 px-3 mb-3 bg-gray">
                                    <div class="row">
                                        <div class="col-12">
                                            <strong class="me-2">Bucky Barns</strong>
                                            <small>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                                <i class="far fa-star"></i>
                                            </small>
                                        </div>
                                        <div class="col-12">
                                            Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce ut ullamcorper quam, non congue odio.
                                            <br>
                                            Aenean faucibus posuere vehicula.
                                        </div>
                                        <div class="col-12">
                                            <small>
                                                <i class="fas fa-clock me-2"></i>5 hours ago
                                            </small>
                                        </div>
                                    </div>
                                </div>
                                <!-- Comments -->

                            </div>
                        </div>
                        <!-- Review -->

                    </div>
                </div>
                <!-- Ratings & Reviews -->

            </div>
        </div>

        <!-- Similar Product -->
        <div class="col-12">
            <div class="row">
                <div class="col-12 py-3">
                    <div class="row">
                        <div class="col-12 text-center text-uppercase">
                            <h2>Similar Products</h2>
                        </div>
                    </div>
                    <div class="row">

                        <!-- Product -->
                        @foreach ($similars as $similar)
                            <div class="col-lg-3 col-sm-6 my-3">
                                <div class="col-12 bg-white text-center h-100 product-item">
                                    <div class="row h-100">
                                        <div class="col-12 p-0 mb-3">
                                            <a href="{{ route('front.pages.product', [$similar->id]) }}">
                                                <img src={{ url("public/storage/images/{$similar->thumbnail}") }} class="img-fluid">
                                            </a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            <a href="{{ route('front.pages.product', [$similar->id]) }}" class="product-name">{{ $similar->name }}</a>
                                        </div>
                                        <div class="col-12 mb-3">
                                            @if (!is_null($similar->discounted_price))                                                
                                                <span class="product-price-old">
                                                   Rs. {{ number_format($similar->discounted_price) }}
                                                </span>
                                                <br>
                                                <span class="product-price">
                                                    Rs. {{ number_format($similar->price) }}
                                                </span>
                                            @else
                                                <span class="product-price">
                                                    Rs. {{ number_format($similar->price) }}
                                                </span>
                                            @endif
                                        </div>
                                        <div class="col-12 mb-3 align-self-end">
                                            <button class="btn btn-outline-dark add-to-cart" data-id="{{ $similar->id }}" type="button"><i class="fas fa-cart-plus me-2"></i>Add to cart</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <!-- Product -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Similar Products -->

    </main>
    <!-- Main Content -->
</div>
@endsection
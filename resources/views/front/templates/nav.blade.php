   
   <!-- Nav Start-->
    <div class="row">
        <nav class="navbar navbar-expand-lg navbar-light bg-white col-12">
            <button class="navbar-toggler d-lg-none border-0" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNav">
                <ul class="navbar-nav mx-auto mt-2 mt-lg-0">
                    <li class="nav-item active">
                        <a class="nav-link" href="{{ route('front.pages.index') }}">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="categories" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Categories</a>
                        <div class="dropdown-menu" aria-labelledby="categories">
                            @foreach ($categories as $category)
                                <a class="dropdown-item" href="{{ route('front.pages.category', [$category->id]) }}">{{ $category->name }}</a>    
                            @endforeach
                        </div>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="brands" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Brands</a>
                        <div class="dropdown-menu" aria-labelledby="brands">
                            @foreach ($brands as $brand)
                                <a class="dropdown-item" href="{{ route('front.pages.brand', [$brand->id]) }}">{{ $brand->name }}</a>    
                            @endforeach
                        </div>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!-- Nav End-->

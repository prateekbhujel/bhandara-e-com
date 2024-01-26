@extends('layouts.front')

@section('title', 'User Dashboard')
    
@section('content')
<div class="col-12">
    <!-- Main Content -->
    <div class="row">
        <div class="col-12 mt-3 text-center text-uppercase">
            <h2>User Dashboard</h2>
        </div>
    </div>

    <main class="row">
        <div class="col-lg-7 col-md-8 col-sm-8 mx-auto bg-white py-3 mb-4">
            <ul class="nav nav-tabs nav-fill" id="myTab" role="tablist">
                
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane" type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="true"><i class="fa-solid fa-gifts me-2"></i>Orders</button>
                </li>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#reviews-tab-pane" type="button" role="tab" aria-controls="reviews-tab-pane" aria-selected="true"><i class="fa-solid fa-comments me-2"></i>Reviews</button>

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="true"><i class="fa-solid fa-user-edit me-2"></i>Edit Profile</button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="reviews-tab" data-bs-toggle="tab" data-bs-target="#password-tab-pane" type="button" role="tab" aria-controls="password-tab-pane" aria-selected="true"><i class="fa-solid fa-asterik me-2"></i>Change Password</button>
                  </li>
              </ul>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active pt-3" id="orders-tab-pane" role="tabpanel" aria-labelledby="orders-tab" tabindex="0">@include('front.user.orders')</div>
              </div>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show" id="reviews-tab-pane" role="tabpanel" aria-labelledby="reviews-tab" tabindex="0">@include('front.user.reviews')</div>
              </div>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">@include('front.user.profile')</div>
              </div>

              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show" id="password-tab-pane" role="tabpanel" aria-labelledby="password-tab" tabindex="0">@include('front.user.password')</div>
              </div>

        </div>

    </main>
    <!-- Main Content -->
</div>
@endsection

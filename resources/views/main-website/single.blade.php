@extends('main-website.layouts.master')
@section('title', $car->title)
@section('content')

    <!-- Hero Section -->
    <div class="hero inner-page" style="background-image: url('{{ asset('images/hero_1_a.jpg') }}');">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-12">
            <div class="intro">
              <h1><strong>{{ $car->title }}</strong></h1>
              <div class="custom-breadcrumbs">
                <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span>
                <a href="{{ route('listingcars') }}">Listings</a> <span class="mx-2">/</span>
                <strong>{{ $car->title }}</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Main Car Content Section -->
    <div class="site-section">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10">
            
            <!-- Car Image -->
            <div class="text-center mb-5">
              <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->title }}" class="img-fluid p-3 bg-white rounded shadow-sm w-100" style="max-height: 500px; object-fit: cover;">
            </div>
            
            <!-- Car Properties / Specs Cards -->
            <div class="grey-bg container-fluid mb-5">
              <section id="minimal-statistics">
                <div class="row mb-3">
                  <div class="col-12 mt-3 mb-1">
                    <h4 class="text-uppercase font-weight-bold">Car Specifications</h4>
                  </div>
                </div>
                
                <div class="row">
                  <!-- Doors -->
                  <div class="col-xl-3 col-sm-6 col-12 mb-3"> 
                    <div class="card shadow-sm border-0">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex align-items-center">
                            <div class="media-body text-left">
                              <h3 class="mb-0">{{ $car->doors }}</h3>
                              <span class="text-muted">Doors</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Luggage -->
                  <div class="col-xl-3 col-sm-6 col-12 mb-3">
                    <div class="card shadow-sm border-0">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex align-items-center">
                            <div class="media-body text-left">
                              <h3 class="mb-0">{{ $car->luggage }}</h3>
                              <span class="text-muted">Luggage</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Passengers -->
                  <div class="col-xl-3 col-sm-6 col-12 mb-3">
                    <div class="card shadow-sm border-0">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex align-items-center">
                            <div class="media-body text-left">
                              <h3 class="mb-0">{{ $car->passengers }}</h3>
                              <span class="text-muted">Passengers</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <!-- Price -->
                  <div class="col-xl-3 col-sm-6 col-12 mb-3">
                    <div class="card shadow-sm border-0">
                      <div class="card-content">
                        <div class="card-body">
                          <div class="media d-flex align-items-center">
                            <div class="media-body text-left">
                              @if ($car->discount_price && $car->discount_price > 0 && $car->discount_price < $car->price)
                                <h3 class="mb-0 text-primary">${{ number_format($car->discount_price, 2) }}</h3>
                                <small><del class="text-muted">${{ number_format($car->price, 2) }}</del> / day</small>
                              @else
                                <h3 class="mb-0 text-primary">${{ number_format($car->price, 2) }}</h3>
                                <span class="text-muted">/ day</span>
                              @endif
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                </div>
              </section>              
            </div>

            <!-- Car Description -->
            <div class="car-description mb-5">
              <h3 class="mb-4">Description</h3>
              <p class="lead" style="line-height: 1.8;">
                {{ $car->content }}
              </p>
            </div>

            <!-- Action Button -->
            <div class="pt-3 border-top text-center">
              <a href="#" class="btn btn-primary btn-lg px-5">Rent This Car Now</a>
            </div>

          </div>
        </div>
      </div>
    </div>

@endsection
      
@extends('main-website.layouts.master')
@section('title', 'Car Listings')
@section('content')

      <div class="hero inner-page" style="background-image: url('{{ asset('images/hero_1_a.jpg') }}');">
  <div class="container">
    <div class="row align-items-end ">
      <div class="col-lg-5">
        <div class="intro">
          <h1><strong>Listings</strong></h1>
          <div class="custom-breadcrumbs">
            <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span> <strong>Listings</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Car Listings</strong></h2>
            <p class="mb-5">Explore our wide range of premium vehicles available for daily and long-term rental.</p>    
          </div>
        </div>

        <div class="row align-items-stretch">
          @forelse ($cars as $car)
            <div class="col-md-6 col-lg-4 mb-4 d-flex">
              <div class="listing d-flex flex-column h-100 w-100">
                <div class="listing-img" style="height: 220px; overflow: hidden;">
                  <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->title }}" class="img-fluid w-100 h-100" style="object-fit: cover;">
                </div>
                <div class="listing-contents d-flex flex-column flex-grow-1 justify-content-between p-4">
                  <div>
                    <h3>{{ $car->title }}</h3>
                    <div class="rent-price mb-3">
                      @if ($car->discount_price && $car->discount_price > 0 && $car->discount_price < $car->price)
                        <strong class="text-primary">${{ number_format($car->discount_price, 2) }}</strong>
                        <del class="text-muted mr-1" style="font-size: 0.9rem;">${{ number_format($car->price, 2) }}</del>
                      @else
                        <strong>${{ number_format($car->price, 2) }}</strong>
                      @endif
                      <span class="mx-1">/</span>day
                    </div>
                    <div class="d-flex justify-content-between mb-3 border-bottom pb-3">
                      <div class="listing-feature">
                        <span class="caption">Luggage:</span>
                        <span class="number">{{ $car->luggage }}</span>
                      </div>
                      <div class="listing-feature">
                        <span class="caption">Doors:</span>
                        <span class="number">{{ $car->doors }}</span>
                      </div>
                      <div class="listing-feature">
                        <span class="caption">Passenger:</span>
                        <span class="number">{{ $car->passengers }}</span>
                      </div>
                    </div>
                    <p>{{ Str::limit($car->content, 80) }}</p>
                  </div>
                  <div class="pt-2">
                    
                    <a href="{{ route('singlepage', $car) }}" class="btn btn-primary btn-sm w-100 text-center">Rent Now</a>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5">
              <p>No active cars available right now.</p>
            </div>
          @endforelse
        </div>

        <!-- HTML Pagination Links -->
        @if ($cars->hasPages())
          <div class="row">
            <div class="col-12 text-center">
              <div class="custom-pagination">
                {{-- Previous Link --}}
                @if ($cars->onFirstPage())
                  <span class="disabled">&laquo;</span>
                @else
                  <a href="{{ $cars->previousPageUrl() }}">&laquo;</a>
                @endif

                {{-- Page Numbers --}}
                @foreach ($cars->getUrlRange(1, $cars->lastPage()) as $page => $url)
                  @if ($page == $cars->currentPage())
                    <span>{{ $page }}</span>
                  @else
                    <a href="{{ $url }}">{{ $page }}</a>
                  @endif
                @endforeach

                {{-- Next Link --}}
                @if ($cars->hasMorePages())
                  <a href="{{ $cars->nextPageUrl() }}">&raquo;</a>
                @else
                  <span class="disabled">&raquo;</span>
                @endif
              </div>
            </div>
          </div>
        @endif

      </div>
    </div>

    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>Testimonials</strong></h2>
            <p class="mb-5">Read feedback and experiences from our trusted customers.</p>    
          </div>
        </div>
        <div class="row">
          @forelse ($testimonials as $testimonial)
            <div class="col-lg-4 mb-4 mb-lg-0">
              <div class="testimonial-2">
                <blockquote class="mb-4">
                  <p>"{{ $testimonial->content }}"</p>
                </blockquote>
                <div class="d-flex v-card align-items-center">
                  <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-fluid mr-3">
                  <div class="author-name">
                    <span class="d-block">{{ $testimonial->name }}</span>
                    <span>{{ $testimonial->position }}</span>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center">
              <p>No testimonials available.</p>
            </div>
          @endforelse
        </div>
      </div>
    </div>

    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white">What are you waiting for?</h2>
            <p class="mb-0 opa-7">Book your favorite car today and enjoy a safe, comfortable drive.</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="#cars-section" class="btn btn-primary btn-white">Rent a car now</a>
          </div>
        </div>
      </div>
    </div>

@endsection
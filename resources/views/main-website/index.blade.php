@extends('main-website.layouts.master')
@section('title', 'Home Page')
@section('content')

    <div class="hero" style="background-image: url('images/hero_1_a.jpg');">
        <div class="container">
            <div class="row align-items-center justify-content-center">
                <div class="col-lg-10">

                    <div class="row mb-5">
                        <div class="col-lg-7 intro">
                            <h1><strong>Rent a car</strong> is within your finger tips.</h1>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="site-section">
        <div class="container">
            <h2 class="section-heading"><strong>How it works?</strong></h2>
            <p class="mb-5">Easy steps to get you started</p>    

            <div class="row mb-5">
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>1</span>
                        <div class="step-inner">
                            <span class="number text-primary">01.</span>
                            <h3>Select a car</h3>
                            <p>Choose from our wide fleet of modern cars that suit your comfort and travel needs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>2</span>
                        <div class="step-inner">
                            <span class="number text-primary">02.</span>
                            <h3>Fill up form</h3>
                            <p>Select your preferred rental dates and submit your booking details online.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 mb-4 mb-lg-0">
                    <div class="step">
                        <span>3</span>
                        <div class="step-inner">
                            <span class="number text-primary">03.</span>
                            <h3>Payment</h3>
                            <p>Complete your payment securely using Paymob and get ready to hit the road.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-lg-4 mx-auto">
                    {{-- <a href="#" class="d-flex align-items-center play-now mx-auto">
                        <span class="icon">
                            <span class="icon-play"></span>
                        </span>
                        <span class="caption">Video how it works</span>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
      
    <div class="site-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 text-center order-lg-2">
                    <div class="img-wrap-1 mb-5">
                        <img src="{{ asset('images/feature_01.png') }}" alt="Car Rental Promo" class="img-fluid">
                    </div>
                </div>
                <div class="col-lg-4 ml-auto order-lg-1">
                    <h3 class="mb-4 section-heading"><strong>You can easily avail our promo for renting a car.</strong></h3>
                    <p class="mb-5">We provide affordable car rental services with zero hidden fees. Book your favorite car today and enjoy high quality service and full insurance options.</p>
                    
                    <p><a href="{{ route('listingcars') }}" class="btn btn-primary">Meet them now</a></p>
                </div>
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Car Listings</strong></h2>
                    <p class="mb-5">Explore our most popular vehicles available for immediate rental.</p>    
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
                    <div class="col-12 text-center">
                        <p>No active cars found.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <div class="site-section bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="section-heading"><strong>Testimonials</strong></h2>
                    <p class="mb-5">What our happy clients say about our car rental service.</p>    
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
                    <p class="mb-0 opa-7">Book your car now and enjoy a seamless rental experience.</p>
                </div>
                <div class="col-lg-5 text-md-right">
                    <a href="{{ route('listingcars') }}" class="btn btn-primary btn-white">Rent a car now</a>
                </div>
            </div>
        </div>
    </div>
@endsection
      

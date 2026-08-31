@extends('main-website.layouts.master')
@section('title', 'About Us')
@section('content')

    <!-- Hero Section -->
    <div class="hero inner-page" style="background-image: url('{{ asset('images/hero_1_a.jpg') }}');">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-5">
            <div class="intro">
              <h1><strong>About Us</strong></h1>
              <div class="custom-breadcrumbs">
                <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span> 
                <strong>About</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Company Overview -->
    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0 order-lg-2">
            <img src="{{ asset('images/hero_2.jpg') }}" alt="About Our Company" class="img-fluid rounded shadow-sm">
          </div>
          <div class="col-lg-5 mr-auto">
            <h2 class="font-weight-bold mb-4">Your Trusted Car Rental Partner</h2>
            <p>We provide seamless and reliable car rental services tailored to meet your travel needs. Whether you need a sleek sedan for business trips or a spacious SUV for family vacations, our fleet is maintained to the highest standards.</p>
            <p>Our mission is to offer comfortable, affordable, and safe transportation with exceptional customer support every step of the way.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Team Section -->
    <div class="site-section bg-light">
      <div class="container">
        <div class="row justify-content-center text-center mb-5 section-2-title">
          <div class="col-md-6">
            <h2 class="mb-4 font-weight-bold">Meet Our Founders</h2>
            <p class="text-muted">The visionary leadership behind our quality rental service.</p>
          </div>
        </div>
        
        <div class="row justify-content-center">
          <!-- Founder 1 -->
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="post-entry-1 h-100 person-1 bg-white p-4 rounded shadow-sm text-center">
              <img src="{{ asset('images/person_1.jpg') }}" alt="Founder" class="img-fluid rounded-circle mb-3 w-50 mx-auto">
              <div class="post-entry-1-contents">
                <span class="meta text-primary font-weight-bold d-block mb-1">Founder & CEO</span>
                <h3 class="font-weight-bold">James Doe</h3>
                <p class="text-muted">Passionate about redefining mobility and creating stress-free car rental experiences for every customer.</p>
              </div>
            </div>
          </div>

          <!-- Founder 2 -->
          <div class="col-lg-4 col-md-6 mb-4">
            <div class="post-entry-1 h-100 person-1 bg-white p-4 rounded shadow-sm text-center">
              <img src="{{ asset('images/person_2.jpg') }}" alt="Co-Founder" class="img-fluid rounded-circle mb-3 w-50 mx-auto">
              <div class="post-entry-1-contents">
                <span class="meta text-primary font-weight-bold d-block mb-1">Co-Founder & COO</span>
                <h3 class="font-weight-bold">Alex Smith</h3>
                <p class="text-muted">Dedicated to fleet management excellence, operational quality, and customer satisfaction standards.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Our History Section -->
    <div class="site-section">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 mb-5 mb-lg-0">
            <img src="{{ asset('images/hero_1.jpg') }}" alt="Our History" class="img-fluid rounded shadow-sm">
          </div>
          <div class="col-lg-5 ml-auto">
            <h2 class="font-weight-bold mb-4">Our Journey</h2>
            <p>Starting with just a small fleet of vehicles, we built our company on trust, transparency, and top-tier service. Over the years, we have expanded our fleet and refined our digital platform to make renting a car fast and simple.</p>
            <p>Today, we proudly serve thousands of satisfied travelers, ensuring every journey is smooth and enjoyable.</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Call to Action Banner -->
    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white font-weight-bold">Ready to Hit the Road?</h2>
            <p class="mb-0 text-white-50">Explore our wide selection of cars and book your ride in minutes.</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="{{ route('listingcars') }}" class="btn btn-white text-primary btn-md px-4 py-3 font-weight-bold">Rent a Car Now</a>
          </div>
        </div>
      </div>
    </div>

@endsection  
     
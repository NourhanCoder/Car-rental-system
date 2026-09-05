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

      <!-- Flash Messages (Payment Alerts) -->
      @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
          <strong>Success!</strong> {{ session('success') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
          <strong>Error!</strong> {{ session('error') }}
          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
      @endif

      <div class="row">
        <div class="col-lg-7">
          <h2 class="section-heading"><strong>Car Listings</strong></h2>
          <p class="mb-5">Explore our wide range of premium vehicles available for daily and long-term rental.</p>    
        </div>
      </div>

      
      <livewire:car-listing />

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
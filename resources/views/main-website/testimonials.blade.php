@extends('main-website.layouts.master')
@section('title', 'Testimonials')
@section('content')

    <!-- Hero Section -->
    <div class="hero inner-page" style="background-image: url('{{ asset('images/hero_1_a.jpg') }}');">
      <div class="container">
        <div class="row align-items-end">
          <div class="col-lg-5">
            <div class="intro">
              <h1><strong>Testimonials</strong></h1>
              <div class="custom-breadcrumbs">
                <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span> 
                <strong>Testimonials</strong>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Testimonials Section -->
    <div class="site-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-lg-7">
            <h2 class="section-heading"><strong>What Our Clients Say</strong></h2>
            <p class="mb-5 text-muted">Read feedback and experiences shared by our valued customers.</p>    
          </div>
        </div>

        <div class="row">
          @forelse($testimonials as $testimonial)
            <div class="col-lg-4 mb-4">
              <div class="testimonial-2 h-100 bg-white p-4 rounded shadow-sm d-flex flex-column justify-content-between">
                <blockquote class="mb-4">
                  <p class="font-italic text-secondary">"{{ $testimonial->content }}"</p>
                </blockquote>
                <div class="d-flex v-card align-items-center mt-auto">
                  <img src="{{ asset('storage/' . $testimonial->image) }}" alt="{{ $testimonial->name }}" class="img-fluid mr-3 rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                  <div class="author-name">
                    <span class="d-block font-weight-bold text-dark">{{ $testimonial->name }}</span>
                    <span class="text-muted small">{{ $testimonial->position ?? 'Customer' }}</span>
                  </div>
                </div>
              </div>
            </div>
          @empty
            <div class="col-12 text-center py-5">
              <p class="text-muted">No testimonials available at the moment.</p>
            </div>
          @endforelse
        </div>

        <!-- Pagination Links -->
        <div class="row mt-5">
          <div class="col-12 d-flex justify-content-center">
            {{ $testimonials->links() }}
          </div>
        </div>

      </div>
    </div>

    <!-- Call to Action Banner -->
    <div class="site-section bg-primary py-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-7 mb-4 mb-md-0">
            <h2 class="mb-0 text-white font-weight-bold">What are you waiting for?</h2>
            <p class="mb-0 text-white-50">Book your ideal car today and enjoy a smooth trip.</p>
          </div>
          <div class="col-lg-5 text-md-right">
            <a href="{{ route('listingcars') }}" class="btn btn-white text-primary btn-md px-4 py-3 font-weight-bold">Rent a car now</a>
          </div>
        </div>
      </div>
    </div>

@endsection
@extends('main-website.layouts.master') 

@section('content')

<!-- Banner Header -->
<div class="hero inner-page" style="background-image: url('{{ asset('images/hero_1_a.jpg') }}');">
  <div class="container">
    <div class="row align-items-end">
      <div class="col-lg-5">
        <div class="intro">
          <h1><strong>Payment</strong></h1>
          <div class="custom-breadcrumbs">
            <a href="{{ route('home') }}">Home</a> <span class="mx-2">/</span> <strong>Checkout</strong>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Content Area -->
<div class="site-section bg-light py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                
                <h3 class="mb-4 text-center">Complete Your Payment</h3>

                <!-- Booking Summary Card -->
                <div class="card shadow-sm mb-4 border-0">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-3 border-bottom pb-2">Booking Summary</h5>
                        <div class="row text-center text-md-left">
                            <div class="col-md-4 mb-2 mb-md-0">
                                <span class="text-muted d-block">Car:</span>
                                <strong>{{ $booking->car->title ?? 'N/A' }}</strong>
                            </div>
                            <div class="col-md-4 mb-2 mb-md-0">
                                <span class="text-muted d-block">Duration:</span>
                                <strong>{{ $booking->start_date }}</strong> to <strong>{{ $booking->end_date }}</strong>
                            </div>
                            <div class="col-md-4">
                                <span class="text-muted d-block">Total Amount:</span>
                                <strong class="text-success h4 mb-0">${{ number_format($booking->total_price, 2) }}</strong>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Paymob iFrame Card -->
                <div class="card shadow-sm p-3 mx-auto" style="max-width: 800px;">
                    <iframe 
                        src="{{ $iframeUrl }}"
                        width="100%" 
                        height="750px" 
                        frameborder="0"
                        style="border: none; border-radius: 8px;">
                    </iframe>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
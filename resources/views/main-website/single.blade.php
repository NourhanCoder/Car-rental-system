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
                        <img src="{{ asset('storage/' . $car->image) }}" alt="{{ $car->title }}"
                            class="img-fluid p-3 bg-white rounded shadow-sm w-100"
                            style="max-height: 500px; object-fit: cover;">
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
                                                            <h3 class="mb-0 text-primary">
                                                                ${{ number_format($car->discount_price, 2) }}</h3>
                                                            <small><del
                                                                    class="text-muted">${{ number_format($car->price, 2) }}</del>
                                                                / day</small>
                                                        @else
                                                            <h3 class="mb-0 text-primary">
                                                                ${{ number_format($car->price, 2) }}</h3>
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

                    <!-- Booking Section Form -->
                    <div class="pt-4 border-top">
                        <h4 class="mb-4 text-center font-weight-bold">Select Rental Period</h4>
                        {{-- عرض أخطاء الـ Validation --}}
  @if($errors->any())
    <div class="alert alert-danger mb-4">
      <ul class="mb-0 pl-3">
        @foreach($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

                        @if (session('error'))
                            <div class="alert alert-danger text-center mb-4">
                                {{ session('error') }}
                            </div>
                        @endif

                        <form action="{{ route('bookings.store') }}" method="POST" class="bg-light p-4 rounded shadow-sm">
  @csrf
  <input type="hidden" name="car_id" value="{{ $car->id }}">

  <div class="row">
    <div class="col-md-6 mb-3">
      <label for="start_date" class="font-weight-bold">Pick-up Date</label>
      <input type="text" name="pick_up_date" id="start_date" class="form-control bg-white" placeholder="Select Start Date" value="{{ old('pick_up_date', request('start_date')) }}" required readonly style="cursor: pointer;">
    </div>

    <div class="col-md-6 mb-3">
      <label for="end_date" class="font-weight-bold">Drop-off Date</label>
      <input type="text" name="drop_off_date" id="end_date" class="form-control bg-white" placeholder="Select End Date" value="{{ old('drop_off_date', request('end_date')) }}" required readonly style="cursor: pointer;">
    </div>
  </div>

  <div class="text-center mt-3">
    @auth
      <button type="submit" class="btn btn-primary btn-lg px-5">Rent This Car Now</button>
    @else
      <a href="{{ route('login') }}" class="btn btn-warning btn-lg px-5">Login to Rent This Car</a>
    @endauth
  </div>
</form>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Flatpickr CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // التواريخ المحجوزة القادمة من الـ Controller
            const bookedRanges = @json($bookedDates ?? []);

            const disableConfig = bookedRanges.map(range => ({
                from: range.from,
                to: range.to
            }));

            const flatpickrOptions = {
                minDate: "today",
                dateFormat: "Y-m-d",
                disable: disableConfig,
                position: "above",
            };

            flatpickr("#start_date", flatpickrOptions);
            flatpickr("#end_date", flatpickrOptions);
        });
    </script>

@endsection

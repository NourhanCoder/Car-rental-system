@extends('main-website.layouts.master')
@section('title', 'Contact US')
@section('content')


    <div class="hero inner-page" style="background-image: url('images/hero_1_a.jpg');">

        <div class="container">
            <div class="row align-items-end ">
                <div class="col-lg-5">

                    <div class="intro">
                        <h1><strong>Contact US</strong></h1>
                        <div class="custom-breadcrumbs"><a href="index.html">Home</a> <span class="mx-2">/</span>
                            <strong>Contact US</strong></div>
                    </div>

                </div>
            </div>
        </div>
    </div>



    <div class="site-section bg-light" id="contact-section">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-7 text-center mb-5">
                    <h2>Contact Us </h2>
                    <p>Have a question or need to rent a car? Contact us or fill out the form below,
                        and our team will help you find the right car for your trip.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-8 mb-5">
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        <div class="form-group row">
                            <div class="col-md-6 mb-4 mb-lg-0">
                                <input type="text"  name="first_name" value="{{ old('first_name') }}" class="form-control" placeholder="First name" required>
                                @error('first_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                            <div class="col-md-6">
                                <input type="text" name="last_name" value="{{ old('last_name') }}" class="form-control" placeholder="Last name" required>
                                @error('last_name') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email address" required>
                                @error('email') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-12">
                                <textarea name="message" id="" class="form-control" placeholder="Write your message."  cols="30"
                                    rows="10" required>{{ old('message') }}</textarea>
                                    @error('message') <span class="text-danger">{{ $message }}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-6 mr-auto">
                                <button type="submit" class="btn btn-block btn-primary text-white py-3 px-5">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-lg-4 ml-auto">
                    <div class="bg-white p-3 p-md-5">
                        <h3 class="text-black mb-4">Contact Info</h3>
                        <ul class="list-unstyled footer-link">
                            <li class="d-block mb-3">
                                <span class="d-block text-black">Address:</span>
                                <span>34 Street Name, City Name Here, United States</span>
                            </li>
                            <li class="d-block mb-3"><span class="d-block text-black">Phone:</span><span>+1 242 4942
                                    290</span></li>
                            <li class="d-block mb-3"><span
                                    class="d-block text-black">Email:</span><span>info@yourdomain.com</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

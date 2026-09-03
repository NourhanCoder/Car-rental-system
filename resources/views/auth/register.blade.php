<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rent Car | Register</title>
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Bootstrap -->
    <link href="{{ asset('admin/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('admin/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('admin/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('admin/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('admin/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper">
            <div class="animate form registration_form" style="opacity: 1; display: block;">
                <section class="login_content">

                    <!-- Register Form -->
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <h1>Create Account</h1>

                        <!-- Name Field -->
                        <div>
                            <input type="text" name="name" class="form-control" placeholder="Full Name"
                                value="{{ old('name') }}" required autofocus autocomplete="name" />
                            @error('name')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Username Field -->
                        <div class="mt-2">
                            <input type="text" name="username" class="form-control" placeholder="Username"
                                value="{{ old('username') }}" required autocomplete="username" />
                            @error('username')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Email Field -->
                        <div class="mt-2">
                            <input type="email" name="email" class="form-control" placeholder="Email"
                                value="{{ old('email') }}" required autocomplete="username" />
                            @error('email')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Phone Field -->
                        <div class="mt-2">
                            <input type="text" name="phone" class="form-control" placeholder="Phone Number"
                                value="{{ old('phone') }}" required autocomplete="tel" />
                            @error('phone')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mt-2">
                            <input type="text" name="address" class="form-control" placeholder="Address"
                                value="{{ old('address') }}" required autocomplete="street-address" />
                            @error('address')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <div class="mt-2">
                            <input type="password" name="password" class="form-control" placeholder="Password" required
                                autocomplete="new-password" />
                            @error('password')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="mt-2">
                            <input type="password" name="password_confirmation" class="form-control"
                                placeholder="Confirm Password" required autocomplete="new-password" />
                            @error('password_confirmation')
                                <span class="text-danger small pull-left">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <div class="mt-3">
                            <button type="submit" class="btn btn-default submit">Submit</button>
                        </div>

                        <div class="clearfix"></div>

                        <div class="separator">
                            <p class="change_link">Already a member?
                                <a href="{{ route('login') }}" class="to_register"> Log in </a>
                            </p>

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1><i class="fa fa-car"></i> Rent Car</h1>
                                <p>©2026 All Rights Reserved. Rent Car System.</p>
                            </div>
                        </div>
                    </form>

                </section>
            </div>
        </div>
    </div>
</body>

</html>
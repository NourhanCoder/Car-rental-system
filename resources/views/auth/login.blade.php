<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rent Car | Login</title>
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
      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>

      <div class="login_wrapper">
        <div class="animate form login_form">
          <section class="login_content">
            
            <!-- Login Form -->
            <form method="POST" action="{{ route('login') }}">
              @csrf

              <h1>Login Form</h1>

              <!-- Session Status Message -->
              @if (session('status'))
                  <div class="alert alert-success">
                      {{ session('status') }}
                  </div>
              @endif

              <!-- Email Field -->
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                @error('email')
                    <span class="text-danger small pull-left">{{ $message }}</span>
                @enderror
              </div>

              <!-- Password Field -->
              <div class="mt-2">
                <input type="password" name="password" class="form-control" placeholder="Password" required autocomplete="current-password" />
                @error('password')
                    <span class="text-danger small pull-left">{{ $message }}</span>
                @enderror
              </div>

              <!-- Submit & Forgot Password -->
              <div class="mt-3">
                <button type="submit" class="btn btn-default submit">Log in</button>
                @if (Route::has('password.request'))
                    <a class="reset_pass" href="{{ route('password.request') }}">Lost your password?</a>
                @endif
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">New to site?
                  <a href="{{ route('register') }}" class="to_register"> Create Account </a>
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
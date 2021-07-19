<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">



</head>
<body class="login-page">
    <div id="app">
      <div class="wrapper">
        <div class="container">


          <div class="login-box">
            <div class="login-logo">
              <a href="../../index2.html"><b>SDC</b>| Admin Login</a>
            </div>
            <!-- /.login-logo -->
            <div class="card">
              <div class="card-body login-card-body">
                <p class="login-box-msg">Enter credentials to login</p>

                <form action="{{ route('admin.loginAction') }}" method="post">
                  @csrf
                  <div class="input-group">
                    <input type="email" value="@if(Session::get('username')) {{Session::get('username')}} @endif" class="form-control @error('username') is-invalid @enderror @if(Session::get('usernameError')) is-invalid @endif" placeholder="Email" name="username">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <span class="text-danger">@error('username') {{$message}} @enderror</span>
                    <span class="text-danger">@if(Session::get('usernameError')) {{Session::get('usernameError')}} @endif</span>
                  </div>
                  <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror @if(Session::get('passwordError')) is-invalid @endif" placeholder="Password" name="password">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <span class="text-danger">@error('password') {{$message}} @enderror</span>
                    <span class="text-danger">@if(Session::get('passwordError')) {{Session::get('passwordError')}} @endif</span>
                  </div>
                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="remember">
                        <label for="remember">
                          Remember Me
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <!-- /.social-auth-links -->

                <p class="mb-1">
                  <a href="{{ route('patients.forgot') }}">I forgot my password</a>
                </p>
              </div>
              <!-- /.login-card-body -->
            </div>
          </div>
          <!-- /.login-box -->



        </div>
      </div>

    </div>


    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>

</body>
</html>

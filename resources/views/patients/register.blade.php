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
<body class="register-page">
    <div id="app">
      <div class="wrapper">
        <div class="container">


          <div class="register-box" style="min-width:550px;">
            <div class="register-logo">
              <a href="#"><b>SDC</b>| Patient Registration</a>
            </div>

            <div class="card">
              <div class="card-body register-card-body">
                <p class="login-box-msg">Enter your personal details below</p>

                <form action="{{ route('patients.registerAction') }}" method="post">
                  @csrf
                  <div class="row">
                    <div class="col-sm-12 col-md-6">
                      <div class="input-group">
                        <input type="text" name="firstname" value="{{ old('firstname') }}@if(Session::get('failPassConfirm')){{Session::get('firstname')}}@endif" class="form-control @error('firstname') is-invalid @enderror" placeholder="First name">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                      <div class="input-group">
                        <input type="text" class="form-control @error('middlename') is-invalid @enderror" placeholder="Middle name" name="middlename" value="{{ old('middlename') }}@if(Session::get('failPassConfirm')){{Session::get('middlename')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('middlename') {{ $message }} @enderror</span>
                      </div>
                    </div>
                  </div>


                  <div class="row">
                    <div class="col-sm-12 col-md-8">
                      <div class="input-group">
                        <input type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Last name" name="lastname" value="{{ old('lastname') }}@if(Session::get('failPassConfirm')){{Session::get('lastname')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-user"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-4">
                      <div class="input-group">
                        <input type="text" class="form-control @error('zip') is-invalid @enderror" placeholder="ZIP code" name="zip" value="{{ old('zip') }}@if(Session::get('failPassConfirm')){{Session::get('zip')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-map-marker-alt"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('zip') {{ $message }} @enderror</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">

                    <div class="col-sm-12 col-md-6">
                      <div class="input-group">
                        <input type="text" class="form-control @error('street') is-invalid @enderror" placeholder="Street" name="street" value="{{ old('street') }}@if(Session::get('failPassConfirm')){{Session::get('street')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-road"></span>
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <span class="text-danger">@error('street') {{ $message }} @enderror</span>
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-6">
                      <div class="input-group">
                        <input type="text" class="form-control @error('barangay') is-invalid @enderror" placeholder="Barangay" name="barangay" value="{{ old('barangay') }}@if(Session::get('failPassConfirm')){{Session::get('barangay')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-map-marked-alt"></span>
                          </div>
                        </div>
                      </div>

                      <div class="mb-3">
                        <span class="text-danger">@error('barangay') {{ $message }} @enderror</span>
                      </div>

                    </div>

                  </div>

                  <div class="input-group">
                    <input type="text" class="form-control @error('municipality') is-invalid @enderror" placeholder="City/Municipality" name="municipality" value="{{ old('municipality') }}@if(Session::get('failPassConfirm')){{Session::get('municipality')}}@endif" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-university"></span>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <span class="text-danger">@error('municipality') {{ $message }} @enderror</span>
                  </div>

                  <div class="input-group">
                    <input type="text" class="form-control @error('province') is-invalid @enderror" placeholder="Province" name="province" value="{{ old('province') }}@if(Session::get('failPassConfirm')){{Session::get('province')}}@endif" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-map"></span>
                      </div>
                    </div>
                  </div>
                  <div class="mb-3">
                    <span class="text-danger">@error('province') {{ $message }} @enderror</span>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 col-md-4">
                      <div class="input-group">
                        <input type="text" class="form-control @error('age') is-invalid @enderror" placeholder="Age" name="age" value="{{ old('age') }}@if(Session::get('failPassConfirm')){{Session::get('age')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('age') {{ $message }} @enderror</span>
                      </div>
                    </div>
                    <div class="col-sm-12 col-md-8">

                      <div class="input-group">
                        <input type="text" class="form-control @error('birthDate') is-invalid @enderror" placeholder="Date of Birth" name="birthDate" value="{{ old('birthDate') }}@if(Session::get('failPassConfirm')){{Session::get('birthDate')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-calendar"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('birthDate') {{ $message }} @enderror</span>
                      </div>
                    </div>
                  </div>

                  <div class="row">
                    <div class="col-sm-12 col-md-12">
                      <div class="input-group">
                        <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile" name="mobile" value="{{ old('mobile') }}@if(Session::get('failPassConfirm')){{Session::get('mobile')}}@endif" >
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                      </div>
                    </div>

                    <div class="col-sm-12 col-md-12">
                      <div class="input-group">
                        <input type="text" class="form-control" placeholder="Medical history @error('medicalHistory') is-invalid @enderror" name="medicalHistory" value="{{ old('medicalHistory') }}@if(Session::get('failPassConfirm')){{Session::get('medicalHistory')}}@endif">
                        <div class="input-group-append">
                          <div class="input-group-text">
                            <span class="fas fa-history"></span>
                          </div>
                        </div>
                      </div>
                      <div class="mb-3">
                        <span class="text-danger">@error('medicalHistory') {{ $message }} @enderror</span>
                      </div>

                    </div>
                  </div>


                  <div class="form-group clearfix">
                    <label for="">Gender</label><br>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="maleGen" name="gender" required>
                      <label for="maleGen">
                        Male
                      </label>
                    </div>
                    <div class="icheck-primary d-inline">
                      <input type="radio" id="femaleGen" name="gender" required>
                      <label for="femaleGen">
                        Female
                      </label>
                    </div>
                  </div>


                  <div class="input-group">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}@if(Session::get('failPassConfirm')) {{Session::get('email')}} @endif" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                  </div>

                  <div class="input-group">
                    <input type="password" class="form-control @error('password') is-invalid @enderror @if(Session::get('failPassConfirm')) is-invalid  @endif" placeholder="Password" name="password" >
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <span class="text-danger">@error('password') {{ $message }} @enderror</span>
                    <span class="text-danger">
                      @if(Session::get('failPassConfirm'))
                        {{Session::get('failPassConfirm')}}
                      @endif
                    </span>
                  </div>

                  <div class="input-group">
                    <input type="password" class="form-control @error('retypePassword') is-invalid @enderror @if(Session::get('failPassConfirm')) is-invalid  @endif" placeholder="Retype password" name="retypePassword">
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                      </div>
                    </div>
                  </div>

                  <div class="mb-3">
                    <span class="text-danger">@error('retypePassword') {{ $message }}  @enderror</span>
                    <span class="text-danger">
                      @if(Session::get('failPassConfirm'))
                        {{Session::get('failPassConfirm')}}
                      @endif
                    </span>
                  </div>

                  <div class="row">
                    <div class="col-8">
                      <div class="icheck-primary">
                        <input type="checkbox" id="agreeTerms" name="terms" value="agree">
                        <label for="agreeTerms">
                         I agree to the <a href="#">terms</a>
                        </label>
                      </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-4">
                      <button type="submit" class="btn btn-primary btn-block">Submit <i class="fa fa-arrow-circle-right"></i></button>
                    </div>
                    <!-- /.col -->
                  </div>
                </form>

                <div class="social-auth-links text-center">
                  <p>- OR -</p>
                </div>
                <span class="text-center d-block"> Already have an account? <a href="{{ route('patients.login')}}" class="text-bold">Login</a></span>

              </div>
              <!-- /.form-box -->
            </div><!-- /.card -->
          </div>
          <!-- /.register-box -->


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

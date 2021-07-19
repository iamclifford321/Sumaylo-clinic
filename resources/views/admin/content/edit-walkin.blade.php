@extends('admin.layout.app')

@section('content')

<div class="container-fluid">
  <div class="pt-5">

  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <div class="card">
        <form action="{{ route('admin.editWalkinAction') }}" method="post">
          @csrf
          <input type="hidden" name="id" value="{{$patient->id}}">
          <div class="card-header">
            <h3 class="card-title">Edit existing patient</h3>
          </div>
          <div class="card-body">

            <p class="login-box-msg"></p>

              <div class="row">
                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="">First name</label>
                    <input type="text" name="firstname" value="{{ old('firstname') ?? $patient->firstName }}" class="form-control @error('firstname') is-invalid @enderror" placeholder="First name">
                    <div class="mb-3">
                      <span class="text-danger">@error('firstname') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>

                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="">Middle name</label>
                    <input type="text" class="form-control @error('middlename') is-invalid @enderror" placeholder="Middle name" name="middlename" value="{{ old('middlename') ?? $patient->middleName }}" >
                    <div class="mb-3">
                      <span class="text-danger">@error('middlename') {{ $message }} @enderror</span>
                    </div>
                  </div>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-12 col-md-8">
                  <div class="form-group">
                    <label for="">Last name</label>
                    <input type="text" class="form-control @error('lastname') is-invalid @enderror" placeholder="Last name" name="lastname" value="{{ old('lastname') ?? $patient->lastName }}" >
                    <div class="mb-3">
                      <span class="text-danger">@error('lastname') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="">ZIP</label>
                    <input type="number" class="form-control @error('zip') is-invalid @enderror" placeholder="ZIP code" name="zip" value="{{ old('zip') ?? $patient->zip  }}">
                    <div class="mb-3">
                      <span class="text-danger">@error('zip') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>
              </div>

              <div class="row">

                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="">Street</label>
                    <input type="text" class="form-control @error('street') is-invalid @enderror" placeholder="Street" name="street" value="{{ old('street') ?? $patient->street  }}">
                    <div class="mb-3">
                      <span class="text-danger">@error('street') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>

                <div class="col-sm-12 col-md-6">
                  <div class="form-group">
                    <label for="">Barangay</label>
                    <input type="text" class="form-control @error('barangay') is-invalid @enderror" placeholder="Barangay" name="barangay" value="{{ old('barangay') ?? $patient->barangay  }}">
                    <div class="mb-3">
                      <span class="text-danger">@error('barangay') {{ $message }} @enderror</span>
                    </div>
                  </div>



                </div>

              </div>

              <div class="form-group">
                <label for="">Municipality</label>
                <input type="text" class="form-control @error('municipality') is-invalid @enderror" placeholder="City/Municipality" name="municipality" value="{{ old('municipality') ?? $patient->city }}" >
                <div class="mb-3">
                  <span class="text-danger">@error('municipality') {{ $message }} @enderror</span>
                </div>
              </div>


              <div class="form-group">
                <label for="">Province</label>
                <input type="text" class="form-control @error('province') is-invalid @enderror" placeholder="Province" name="province" value="{{ old('province') ?? $patient->province }}" >
                <div class="mb-3">
                  <span class="text-danger">@error('province') {{ $message }} @enderror</span>
                </div>
              </div>


              <div class="row">
                <div class="col-sm-12 col-md-4">
                  <div class="form-group">
                    <label for="">Age</label>
                    <input type="text" class="form-control @error('age') is-invalid @enderror" placeholder="Age" name="age" value="{{ old('age') ?? $patient->age  }}" >
                    <div class="mb-3">
                      <span class="text-danger">@error('age') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>
                <div class="col-sm-12 col-md-8">

                  <div class="form-group">
                    <label for="">Birth date</label>
                    <input type="text" class="form-control @error('birthDate') is-invalid @enderror" placeholder="Date of Birth" name="birthDate" value="{{ old('birthDate') ?? $patient->dateOfBirth }}" >
                    <div class="mb-3">
                      <span class="text-danger">@error('birthDate') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>
              </div>
              <div class="form-group clearfix">
                <label for="">Gender</label><br>
                <div class="icheck-primary d-inline">
                  <input type="radio" id="maleGen" name="gender" value="Male"
                  @if( old('gender') )

                    {{ (old('gender') == 'Male') ? 'checked' : '' }}


                  @else

                    {{ ($patient->gender == 'Male') ? 'checked' : ''}}

                  @endif>
                  <label for="maleGen">
                    Male
                  </label>
                </div>
                <div class="icheck-primary d-inline">
                  <input type="radio" id="femaleGen" name="gender" value="Female"
                  @if( old('gender') )

                    {{ (old('gender') == 'Female') ? 'checked' : '' }}


                  @else

                    {{ ($patient->gender == 'Female') ? 'checked' : ''}}

                  @endif>
                  <label for="femaleGen">
                    Female
                  </label>
                </div>
                <div class="mb-3">
                  <span class="text-danger">@error('gender') {{ $message }} @enderror</span>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="">Mobile</label>
                    <input type="text" class="form-control @error('mobile') is-invalid @enderror" placeholder="Mobile" name="mobile" value="{{ old('mobile') ?? $patient->Phone }}" >
                    <div class="mb-3">
                      <span class="text-danger">@error('mobile') {{ $message }} @enderror</span>
                    </div>
                  </div>

                </div>

                <div class="col-sm-12 col-md-12">
                  <div class="form-group">
                    <label for="">Medical history</label>
                    <input type="text" class="form-control" placeholder="Medical history @error('medicalHistory') is-invalid @enderror" name="medicalHistory" value="{{ old('medicalHistory') ?? $patient->medicalHistory }}">
                    <div class="mb-3">
                      <span class="text-danger">@error('medicalHistory') {{ $message }} @enderror</span>
                    </div>
                  </div>


                </div>
              </div>

              <div class="form-group">

                <label for="">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') ?? $patient->email }}" >
                <div class="mb-3">
                  <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                </div>

              </div>




          </div>
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" class="btn btn-secondary">Save</button>
            </div>
          </div>
        </form>
        <!-- /.form-box -->
      </div><!-- /.card -->
    </div>
  </div>
</div>
@if(Session::get('ActionMsg') != null)
  <script type="text/javascript">

    $(document).ready(function(){
      Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      Toast.fire({
        icon: 'success',
        title: "&nbsp;&nbsp; {{Session::get('ActionMsg')}}!"
      });
    })

  </script>
@endif
@endsection

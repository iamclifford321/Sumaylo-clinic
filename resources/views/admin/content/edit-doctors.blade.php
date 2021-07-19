@extends('admin.layout.app')

@section('content')
<!-- <div class="all-cover-add-new"></div> -->

<div class="container-fluid">
  <div class="pt-5">

  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <form class="" action="{{route('admin.editDoctorAction')}}" method="post" style="/**max-height:800px; overflow-y:scroll; overflow-x:hidden">
        @csrf

        <div class="card">
          <input type="hidden" name="id" value="{{$doctor->id}}">
          <div class="card-header">
            <h3 class="card-title">Edit Doctor</h3>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">First Name</label>
                  <input type="text" name="firstName" value="{{old('firstName') ?? $doctor->firstName}}" class="form-control @error('firstName') is-invalid @enderror">
                  <span class="text-danger">@error('firstName') {{$message}} @enderror</span>
                </div>
              </div>

              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">Last Name</label>
                  <input type="text" name="lastName" value="{{old('lastName') ?? $doctor->lastName}}" class="form-control @error('lastName') is-invalid @enderror">
                  <span class="text-danger">@error('lastName') {{$message}} @enderror</span>
                </div>
              </div>
            </div>


            <div class="form-group clearfix">
              <label for="">Gender</label> <span class="text-danger pl-2">@error('gender') - {{$message}} @enderror</span><br>
              <div class="icheck-primary d-inline">
                <input type="radio" id="maleGen" name="gender" value="Male"
                @if( old('gender') )

                  {{ (old('gender') == 'Male') ? 'checked' : '' }}


                @else

                  {{ ($doctor->gender == 'Male') ? 'checked' : ''}}

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

                  {{ ($doctor->gender == 'Female') ? 'checked' : ''}}

                @endif>
                <label for="femaleGen">
                  Female
                </label>
              </div>
            </div>




            <div class="row">
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="">Age</label>
                  <input type="number" name="age" value="{{old('age') ?? $doctor->age}}" class="form-control @error('age') is-invalid @enderror">
                  <span class="text-danger">@error('age') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Birth Date</label>
                  <input type="text" name="birthDate" value="{{old('birthDate') ?? $doctor->birthDate}}" class="form-control @error('birthDate') is-invalid @enderror">
                  <span class="text-danger">@error('birthDate') {{$message}} @enderror</span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">Contact number</label>
                  <input type="number" name="phone" value="{{old('phone') ?? $doctor->phoneNumber}}" class="form-control @error('phone') is-invalid @enderror">
                  <span class="text-danger">@error('phone') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="email" name="email" value="{{old('email') ?? $doctor->email}}" class="form-control @error('email') is-invalid @enderror">
                  <span class="text-danger">@error('email') {{$message}} @enderror</span>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="">Zip code</label>
                  <input type="number" name="zip" value="{{old('zip') ?? $doctor->zip}}" class="form-control @error('zip') is-invalid @enderror">
                  <span class="text-danger">@error('zip') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Street</label>
                  <input type="text" name="street" value="{{old('street') ?? $doctor->street}}" class="form-control @error('street') is-invalid @enderror">
                  <span class="text-danger">@error('street') {{$message}} @enderror</span>
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">Barangay</label>
                  <input type="text" name="barangay" value="{{old('barangay') ?? $doctor->barangay}}" class="form-control @error('barangay') is-invalid @enderror">
                  <span class="text-danger">@error('barangay') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-6">
                <div class="form-group">
                  <label for="">Municipality</label>
                  <input type="text" name="municipality" value="{{old('municipality') ?? $doctor->municipality}}" class="form-control @error('municipality') is-invalid @enderror">
                  <span class="text-danger">@error('municipality') {{$message}} @enderror</span>
                </div>
              </div>

              <div class="col-sm-12 col-md-12">
                <div class="form-group">
                  <label for="">Province</label>
                  <input type="text" name="province" value="{{old('province') ?? $doctor->province}}" class="form-control @error('province') is-invalid @enderror">
                  <span class="text-danger">@error('province') {{$message}} @enderror</span>
                </div>
              </div>
            </div>


              <div class="form-group">
                <label>Services</label> <span class="text-danger">@error('services') - {{$message}} @enderror</span><br>
                @foreach($services as $service)
                <div class="icheck-primary d-block">
                  <input type="checkbox" id="{{$service->id}}" name="services[]" value="{{$service->id}}"
                    {{ (is_array(old('services')) && in_array($service->id, old('services'))) ? 'checked' : '' }}
                    {{ (is_array($servicesOfDoc) && in_array($service->id, $servicesOfDoc)) ? 'checked' : '' }}
                    >
                  <label for="{{$service->id}}">
                    {{$service->name}}
                  </label>
                </div>
                @endforeach
              </div>
          </div>
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" name="button" class="btn btn-secondary" @if(count($services)<1) disabled="disabled" @endif >Save</button>
            </div>
          </div>
        </div>
      </form>
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

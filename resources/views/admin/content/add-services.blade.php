@extends('admin.layout.app')

@section('content')
<div class="all-cover-add-new"></div>
<div class="container-fluid">
  <div class="pt-5">

  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <form class="" action="{{route('admin.addServiceAction')}}" method="post">
        @csrf
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Add New Service</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Service Name</label>
              <input type="text" name="name" value="{{old('name')}}" class="form-control @error('name') is-invalid @enderror">
              <span class="text-danger">@error('name') {{$message}} @enderror</span>
            </div>


            <div class="row">
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Service Fee</label>
                  <input type="number" name="fee" value="{{old('fee')}}" class="form-control @error('fee') is-invalid @enderror">
                  <span class="text-danger">@error('fee') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="">Service Duration</label>
                  <input type="text" name="duration" value="{{old('duration')}}" class="form-control @error('duration') is-invalid @enderror" placeholder="0:00">
                  <span class="text-danger">@error('duration') {{$message}} @enderror</span>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" name="button" class="btn btn-secondary">Save</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
@if(Session::get('ServiceActionMsg') != null)
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
        title: "&nbsp;&nbsp; {{Session::get('ServiceActionMsg')}}!"
      });
    })
  </script>
@endif
@endsection

@extends('admin.layout.app')

@section('content')
<div class="all-cover-add-new"></div>
<div class="container-fluid">
  <div class="pt-5">

  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-4">
      <form class="" action="{{route('admin.updateServiceAction')}}" method="post">
        @csrf
        @method('PATCH')
        <div class="card">
          <input type="hidden" name="id" value="{{ $serviceRecord->id }}">
          <div class="card-header">
            <h3 class="card-title">Edit service</h3>
          </div>
          <div class="card-body">
            <div class="form-group">
              <label for="">Service Name</label>
              <input type="text" name="name" value="{{old('name') ?? $serviceRecord->name}}" class="form-control @error('name') is-invalid @enderror">
              <span class="text-danger">@error('name') {{$message}} @enderror</span>
            </div>
            <?php //dd($serviceRecord); ?>

            <div class="row">
              <div class="col-sm-12 col-md-8">
                <div class="form-group">
                  <label for="">Service Fee</label>
                  <input type="number" name="fee" value="{{ old('fee') ?? $serviceRecord->amount }}" class="form-control @error('fee') is-invalid @enderror">
                  <span class="text-danger">@error('fee') {{$message}} @enderror</span>
                </div>
              </div>
              <div class="col-sm-12 col-md-4">
                <div class="form-group">
                  <label for="">Service Duration</label>
                  <input type="text" name="duration" value="{{old('duration') ?? substr($serviceRecord->duration, 0, 5)}}" class="form-control @error('duration') is-invalid @enderror">
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

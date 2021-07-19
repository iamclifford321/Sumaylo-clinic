@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
  <div class="content-header">
    <h1>|Services lists</h1>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"> All Services </h3>
    </div>
    <div class="card-body">
      <div class="table-data">
        <table class="table" id="table-services">
          <thead>
            <th>#</th>
            <th>Service name</th>
            <th>Duration</th>
            <th>Price</th>
            <th>Action</th>
          </thead>
          <tbody>
            <?php $i = 1; ?>
            @foreach($services as $service)
            <tr>
              <td>{{ $i }}</td>
              <td>{{$service->name}}</td>
              <td>{{ substr($service->duration, 0, 5)}}</td>
              <td> <?php echo '₱' . number_format($service->amount, 2); ?></td>
              <td>
                <div class="dropdown show">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/admin/services/{{$service->id}}">Edit</a>
                    <a class="dropdown-item delete-service" href="#" record-Id='{{ $service->id }}'>Delete</a>
                  </div>
                </div>

              </td>
            </tr>
            <?php $i++; ?>
            @endforeach

          </tbody>
        </table>
      </div>
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
<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click', '.delete-service', function(){

    var Id = $(this).attr('record-Id');
    Swal.fire({
      title: 'Do you want to Delete this record?',
      showDenyButton: true,
      confirmButtonText: `Yes`,
      denyButtonText: `No`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {

        window.location.href = 'services/delete/' + Id;

      }
    })

  });

  $("#table-services").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["print"]
  }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');


})


</script>
@endsection

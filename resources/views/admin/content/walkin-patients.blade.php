@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
  <div class="content-header">
    <h1>|Walk-in patient lists</h1>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"> All walk-in patients </h3>
    </div>
    <div class="card-body">
      <div class="table-data">
        <div class="" id="example1_wrapper">

        </div>
        <table class="table table-bordered" id="table-patients">
          <thead>
            <th>Patient's information</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach( $allWalkins as $allWalkin )
            <tr>
              <td>
                <div class="pt-2">
                  <i class="fas fa-address-card"></i>&nbsp; &nbsp;<b>{{ ucfirst($allWalkin->firstName) }} {{ ucfirst($allWalkin->middleName) }} {{ucfirst($allWalkin->lastName)}}</b>
                  <a class="text-muted float-right" data-toggle="collapse" href="#collapse{{$allWalkin->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$allWalkin->id}}">
                    More details..
                  </a>
                </div>

                <div class="collapse pt-3" id="collapse{{$allWalkin->id}}">
                  <div class="">


                    <div class="pt-2">
                      <i class="fas fa-calendar-alt"></i>&nbsp; &nbsp;<b>{{date('M j, Y', strtotime($allWalkin->birthDate))}} | {{$allWalkin->age}} yrs old</b>
                    </div>

                    <div class="pt-2">
                      <i class="fas fa-at"></i>&nbsp; &nbsp; <b>{{$allWalkin->email}}</b>
                    </div>

                    <div class="pt-2">
                      <i class="fas fa-venus-mars"></i>&nbsp; &nbsp; <b>{{$allWalkin->gender}}</b>
                    </div>


                    <div class="pt-2">
                    <i class="fas fa-phone-alt"></i> &nbsp; &nbsp; <b>{{$allWalkin->Phone}}</b>
                    </div>


                    <div class="pt-2">
                      <i class="fas fa-map-marker-alt"></i>&nbsp; &nbsp; <b>{{$allWalkin->zip}}</b>
                    </div>

                    <div class="pt-2">
                      <i class="fas fa-map-marked"></i>&nbsp; &nbsp; <b>{{$allWalkin->street}}, {{$allWalkin->barangay}} {{$allWalkin->municipality}}, {{$allWalkin->province}}</b>
                    </div>
                  </div>
                </div>

              </td>
              <td>
                <div class="dropdown show">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/admin/walkin/edit/{{$allWalkin['id']}}">Edit</a>
                    <a class="dropdown-item delete-doctor" href="#" record-Id='{{$allWalkin['id']}}'>Delete</a>
                  </div>
                </div>
              </td>
            </tr>
            @endforeach


          </tbody>
        </table>
      </div>
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
<script type="text/javascript">
$(document).ready(function(){

  $(document).on('click', '.delete-doctor', function(){

    var Id = $(this).attr('record-Id');
    Swal.fire({
      title: 'Do you want to Delete this record?',
      showDenyButton: true,
      confirmButtonText: `Yes`,
      denyButtonText: `No`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        window.location.href = 'walkin/delete/' + Id;
      }
    })

  });

  $("#table-patients").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "columnDefs": [{
    "targets": 2,
    "orderable": false
    }]
  })
})


</script>
@endsection

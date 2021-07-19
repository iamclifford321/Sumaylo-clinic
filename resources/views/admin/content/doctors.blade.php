@extends('admin.layout.app')

@section('content')
<div class="container-fluid">
  <div class="content-header">
    <h1>|Doctors lists</h1>
  </div>
  <div class="card">
    <div class="card-header">
      <h3 class="card-title"> All doctors </h3>
    </div>
    <div class="card-body">
      <div class="table-data">
        <div class="" id="example1_wrapper">

        </div>
        <table class="table table-bordered" id="table-doctors">
          <thead>
            <th>Doctor's Information</th>
            <th>Services</th>
            <th>Action</th>
          </thead>
          <tbody>
            @foreach($doctors as $doctor)

            <tr>
              <td class="align-middle">
                <div class="">
                 <!--  <i class="fas fa-id-card"></i>&nbsp; &nbsp; --> <b> {{$doctor->firstName}} {{$doctor->lastName}}</b>
                  <a class="text-muted float-right" data-toggle="collapse" href="#collapse{{$doctor->id}}" role="button" aria-expanded="false" aria-controls="collapse{{$doctor->id}}">
                    More details..
                  </a>
                </div>
                <div class="collapse pt-3" id="collapse{{$doctor->id}}">
                  <div class="">


                      <div class="pt-2">
                        <i class="fas fa-calendar-alt"></i>&nbsp; &nbsp;<b> {{date('M j, Y', strtotime($doctor->birthDate))}} | {{$doctor->age}} yrs old</b>
                      </div>

                      <div class="pt-2">
                        <i class="fas fa-at"></i>&nbsp; &nbsp; <b>{{$doctor->email}}</b>
                      </div>

                      <div class="pt-2">
                        <i class="fas fa-venus-mars"></i>&nbsp; &nbsp; <b>{{$doctor->gender}}</b>
                      </div>


                      <div class="pt-2">
                      <i class="fas fa-phone-alt"></i> &nbsp; &nbsp; <b>{{$doctor->phoneNumber}}</b>
                      </div>


                      <div class="pt-2">
                        <i class="fas fa-map-marker-alt"></i>&nbsp; &nbsp; <b>{{$doctor->zip}}</b>
                      </div>

                      <div class="pt-2">
                        <i class="fas fa-map-marked"></i>&nbsp; &nbsp; <b>{{$doctor->street}}, {{$doctor->barangay}}, {{$doctor->municipality}}, {{$doctor->province}}</b>
                      </div>


                  </div>
                </div>

              </td>
              <td class="align-middle">
                <ul class="pl-3">

                  <?php
                    if (count($doctorsWithServices) > 0) {
                      if (array_key_exists($doctor['id'], $doctorsWithServices)) {
                        ?>

                        @php $doctorsWithServicePartId = $doctorsWithServices[$doctor['id']] @endphp
                        @foreach($doctorsWithServicePartId as $doctorsWithService)
                        <li>{{$doctorsWithService}}</li>

                        @endforeach

                        <?php
                      }
                    }else{
                      echo 'No services found';
                    }
                   ?>


                </ul>
              </td>
              <td>
                <div class="dropdown show">
                  <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Action</a>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                    <a class="dropdown-item" href="/admin/doctor/edit/{{$doctor['id']}}">Edit</a>
                    <a class="dropdown-item delete-doctor" href="#" record-Id='{{$doctor['id']}}'>Delete</a>
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
        window.location.href = 'doctor/delete/' + Id;
      }
    })

  });

  $("#table-doctors").DataTable({
    "responsive": true, "lengthChange": false, "autoWidth": false,
    "buttons": ["print"],
    "columnDefs": [{
    "targets": 2,
    "orderable": false
    }]
  }).buttons().container().appendTo('#table-doctors_wrapper div.row:nth-child(1) div.col-sm-12:nth-child(1)');
})


</script>
@endsection

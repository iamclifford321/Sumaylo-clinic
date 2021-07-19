@extends('admin.layout.app')

@section('content')
<!-- <div class="all-cover-add-new"></div> -->
<style media="screen">
div.container-progressbar{
  width: 100%;
}
ul.progressbar {
  padding: 0;
  margin: 0 0 50px 0;
  counter-reset: step;
}
ul.progressbar li {
  list-style: none;
  display: inline-block;
  width: 30.33%;
  position: relative;
  text-align: center;
  cursor: pointer;
}
ul.progressbar li::before {
  content: counter(step);
  counter-increment: step;
  width: 30px;
  height: 30px;
  line-height : 30px;
  border: 1px solid #ddd;
  border-radius: 100%;
  display: block;
  text-align: center;
  margin: 0 auto 10px auto;
  background-color: #fff;
}
ul.progressbar li::after {
  content: "";
  position: absolute;
  width: 65%;
  height: 3px;
  background-color: #ddd;
  top: 15px;
  left: -33%;
  z-index: 0;
}
ul.progressbar li:first-child:after {
  content: none;
}
ul.progressbar li.active {
  color: green;
}
ul.progressbar li.active:before {
  border-color: green;
}
ul.progressbar li.active + li:after {
  background-color: green;
}
span.floatAmount{
  position:absolute;
  right: 10%;
}
</style>
<div class="container-fluid">
  <div class="pt-5">

  </div>

  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <div class="container-progressbar">
        <ul class="progressbar">
          <li class="active">Step 1</li>
          <li>Step 2</li>
          <li>Step 3</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <form class="" action="{{route('admin.registerServiceAndDoctorWalkin')}}" method="post" style="/**max-height:800px; overflow-y:scroll; overflow-x:hidden">
        @csrf
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Services and Doctor</h3>
          </div>
          <div class="card-body">
            <input type="hidden" name="serviceAmount">
            <!-- Content here -->
            <div class="form-group">
              <label for="">Patient</label>
              <select class="form-control" name="patientName">
                <option value="" selected>-- Select Doctor --</option>
                @foreach($patients as $patient)
                  <option value="{{$patient->id}}">{{$patient->firstName}} {{$patient->lastName}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group">
              <label for="">Doctor</label>
              <select name="doctorDrop" class="form-control">
                <option value="" selected>-- Select Doctor --</option>
                @foreach($doctors as $doctor)
                  <option value="{{$doctor->id}}">{{$doctor->firstName}} {{$doctor->lastName}}</option>
                @endforeach
              </select>
            </div>

            <!-- Services Here -->

            <div id="doctor-content">

            </div>
            <div id="totalAmountServiceChoosen mb-3">
              <span class="text-bold">Total payment</span>
              <span class="floatAmount text-bold" id="totalPayment">
                ₱00.00
              </span>
            </div>

          </div>
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" name="next" class="btn btn-secondary" disabled>next</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
  $('[name=patientName]').on('change', function(){

    let isNoTrue = false;
    let amountPerService = 0;
    $('.servicesForDoctor').each(function(){

      if ($(this).prop('checked') == true) {
        amountPerService += parseFloat( $(this).attr('amount'));
        isNoTrue = true;
      }

    });

    if ( $(this).val() == '' || $(this).val() == null || !isNoTrue ) {
      $('[name=next]').attr('disabled','disabled');
    }else{
      $('[name=next]').removeAttr('disabled');
    }
  })
  $('[name=doctorDrop]').on('change', function(){
    $('#totalPayment').text('₱00.00');
    if (!$(this).val() == '') {

      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN':  '<?php echo csrf_token() ?>'
         }
       });
      $.ajax({
        type : 'POST',
        dataType: 'json',
        url : '/admin/walkin/getDoctorNService',
        data : {
          doctorId : $(this).val()
        },
        success: function(rspns){

          if (rspns.length > 0) {
            $('#doctor-content').html(
              `<div class="form-group">
                <label>Services</label>
                <div class="radioButtonContent"></div>
              </div>`
            );
            for (var i = 0; i < rspns.length; i++) {
              $('div.radioButtonContent').append(`
                <div class="d-block clear-fix">
                  <div class="icheck-primary d-block">
                    <input type="checkbox" id="${rspns[i]['Id']}" name="serviceCho[]" class="servicesForDoctor" value="${rspns[i]['Id']}" amount="${rspns[i]['amount']}" services_name="${rspns[i]['Name']}">
                    <label for="${rspns[i]['Id']}">
                      ${rspns[i]['Name']}
                    </label>
                    <span class="floatAmount text-bold">
                      ₱${rspns[i]['amount'].toFixed(2)}
                    </span>
                  </div>
                </div>
                `);
            }
            $('[name=next]').attr('disabled', 'disable');
          }else{
            $('[name=next]').attr('disabled', 'disable');
            $('#doctor-content').html(`<h5>No availlable service</h5>`);
          }
        }
      })
    }else{
      $('[name=next]').attr('disabled', 'disable');
      $('#doctor-content').html(`<h5>No availlable service</h5>`);
    }
  });

  $(document).on('change', '.servicesForDoctor', function(){

    let isNoTrue = false;
    let amountPerService = 0;
    $('.servicesForDoctor').each(function(){

      if ($(this).prop('checked') == true) {
        amountPerService += parseFloat( $(this).attr('amount'));
        isNoTrue = true;
      }

    });

    if (isNoTrue) {
      $('[name=next]').removeAttr('disabled');
    }else{
      $('[name=next]').attr('disabled','disabled');
    }
    $('#totalPayment').text('₱' + amountPerService.toFixed(2));
    $('[name=serviceAmount]').val(amountPerService.toFixed(2));


  })
})

</script>
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

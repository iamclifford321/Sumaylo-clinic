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

.datepicker table {
  margin: 0;
  -webkit-touch-callout: none;
  -webkit-user-select: none;
  -khtml-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
  width: 100%;
}
.datepicker {
  direction: ltr;
  padding: 0;
  width: 100% !important;
}
.datepicker td {
  line-height: 32px;
  padding: 15px !important;
  text-align: center;
  width: 60px;
}
.datepicker thead th,
.datepicker tfoot th {
  font-weight: 600;
  padding: 15px !important;
}
.datepicker.dropdown-menu td[class$=disabled], .datepicker.datepicker-inline td[class$=disabled]{
  color: #721c24 !important;
  background-color: #f8d7da !important;
  border-color: #f5c6cb !important;
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
          <li class="active">Step 2</li>
          <li>Step 3</li>
        </ul>
      </div>
    </div>
  </div>
  <div class="row justify-content-md-center">
    <div class="col-sm-12 col-md-5">
      <form class="" action="{{route('admin.AppoinmentDateStep')}}" method="post" style="/**max-height:800px; overflow-y:scroll; overflow-x:hidden">
        @csrf
        <div class="card">

          <div class="card-header">
            <h3 class="card-title">Appointment date</h3>
          </div>
          <div class="card-body">
            <input type="hidden" name="serviceAmount" value="{{$serAmout}}">
            <input type="hidden" name="patient" value="{{$patient}}">
            <input type="hidden" name="serviceDuration" value="{{$timeRange}}">
            <input type="hidden" name="serviceName" value="{{$serviceName}}">
            <input type="hidden" name="doctorId" value="{{$doctorId}}">
            <input type="hidden" name="services" value="{{serialize($services)}}">
            <input type="hidden" name="timeChoosen">
            <!-- Content here -->

            <div class="form-group">
              <label for="">Date</label>
              <input type="hidden"  value="" readonly class="form-control" id="theDate">
              <div class="mt-2" id="datepicker"></div>
            </div>

            <div class="form-group">
              <label for="" id="timeLabel"></label>
              <div class="">
                <div id="schedule"></div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <div class="float-right">
              <button type="submit" name="next" class="btn btn-secondary" disabled >next</button>
            </div>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){

  // Date picker

  var disableDates = <?php echo json_encode($disabledDates); ?>;
  $('#datepicker').datepicker({
      startDate			: new Date(),
      format: 'yyyy-mm-dd',
      daysOfWeekDisabled: [0,6],
      beforeShowDay	: function(date){
                      dmy = date.getFullYear() + "-" + (date.getMonth('MM') + 1).toString().padStart(2, '0') +  "-" + date.getDate().toString().padStart(2, '0');
                      if(disableDates.indexOf(dmy) != -1){
                          return false;
                      }
                      else{
                          return true;
                      }
      }
  });

  $('#datepicker').on('changeDate', function() {
      $('#theDate').val(
          $('#datepicker').datepicker('getFormattedDate')
      );

      checkForScheduled($('#datepicker').datepicker('getFormattedDate'));
      $('[name=timeChoosen]').val('');
      $('[name=next]').attr('disabled', 'disabled');
  });

  function checkForScheduled( dateNeeded ){
    $('#timeLabel').text('Time');
    $('#schedule').html('');
    if (dateNeeded != '' || dateNeeded != null) {

      $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN':  '<?php echo csrf_token() ?>'
         }
       });

       $.ajax({
         type : 'POST',
         dataType: 'json',
         url : '/admin/walkin/getDateTimeScheduled',
         data : {
           theDate : dateNeeded
         },
         success: function( rspns ){

           // Decalaring variable schedule
           var Scheds = [
             {
               time : '00:00:00',
               range : '08:00:00',
               isDefault : true,
               content : 'Time off'
             },
             {
               time : '12:00:00',
               range : '01:00:00',
               isDefault : true,
               content : 'Lunch break'
             },
             {
               time : '17:00:00',
               range : '07:00:00',
               isDefault : true,
               content : 'Time off'
             }
           ];

           for (var i = 0; i < rspns.length; i++) {
             Scheds.push(rspns[i]);
           }
           // time Scheduler
           $('#schedule').css({
             'height' : '350px'
           })
           $('#schedule').CUScheduling({
               schedules : Scheds,
               timeRange : $('[name=serviceDuration]').val(),
               getTheTime: function(res) {
                 $('[name=timeChoosen]').val(res);
                 $('[name=next]').removeAttr('disabled');
               }
           });

         }
       })

    }


  }
  // --------------------------------------------------------------------------------------
  // --------------------------------------------------------------------------------------
  // --------------------------------------------------------------------------------------






  // --------------------------------------------------------------------------------------
  // --------------------------------------------------------------------------------------
  // --------------------------------------------------------------------------------------
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

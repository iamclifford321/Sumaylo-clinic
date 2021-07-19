<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Services;
use App\Models\doctorNservices;
use App\Models\doctor;
use App\Models\appointment;


class bookAppointmentAdminCtrl extends Controller
{
    public function bookAppointmentWalkIn(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      $doctors = Doctor::all();
      $users = Users::Where('type', '!=', '0')->get();
      return view('admin.content.book', [
        'userLogged' => $data,
        'doctors' => $doctors,
        'patients' => $users
      ]);
    }

    public function getDoctorNService(Request $req){


      $doctors = DoctorNservices::where('doctor_id', '=', $req->doctorId)->get();
      $arrayOfServices = [];
      foreach ($doctors as $doctor) {
        $objOfservice = array();
        $serviceinServices = Services::where('id', '=', $doctor->service_id)->first();
        $objOfservice['Id'] = $serviceinServices->id;
        $objOfservice['Name'] = $serviceinServices->name;
        $objOfservice['amount'] = $serviceinServices->amount;
        $objOfservice['duration'] = $serviceinServices->duration;
        array_push($arrayOfServices, $objOfservice);
      }

      echo json_encode($arrayOfServices);
    }

    public function registerServiceAndDoctorWalkin(Request $req){

      $hours = 0;
      $minutes = 0;
      $strHours = '';
      $strMinutes = '';
      $timeRange = '';
      $servicesNames = [];
      foreach ($req->serviceCho as $key => $serviceId) {
        $services = Services::where('id', '=', $serviceId)->first();
        array_push($servicesNames, $services->name);
        $timeDuration = explode(':', $services->duration);
        $hours += (int)$timeDuration[0];
        $minutes += (int)$timeDuration[1];
        if ($minutes > 59) {
          $minutes = 0;
          $hours ++;
        }
      }
      if (strlen((String)$hours) == 1) {
        $strHours = '0' . (String)$hours;
      }else{
        $strHours = (String)$hours;
      }
      if (strlen((String)$minutes) == 1) {
        $strMinutes = '0' . (String)$minutes;
      }else{
        $strMinutes = (String)$minutes;
      }
      $timeRange = $strHours . ':' . $strMinutes . ':' . '00';

      $data = Users::where('id', '=', Session('adminId'))->first();


      $arrAll  = array();
      $arrForRtrn  = array();

      $serviceinServicesDates = Appointment::Where('appointmentDate', '>=', date('Y-m-d'))->get();
      foreach ($serviceinServicesDates as $key => $serviceinServicesDate) {
        array_push($arrAll, $serviceinServicesDate['appointmentDate']);
      }

      foreach ( array_count_values($arrAll) as $key => $value) {
        if ($value >= 10) {
          // echo $key;
          array_push( $arrForRtrn, str_replace("/", "-", $key) );
        }
      }

      return view('admin.content.book2', [
        'patient' => $req->patientName,
        'userLogged' => $data,
        'timeRange' => $timeRange,
        'doctorId' => $req->doctorDrop,
        'services' => $req->serviceCho,
        'serviceName' => implode(', ', $servicesNames),
        'serAmout' => $req->serviceAmount,
        'disabledDates' => $arrForRtrn
      ]);
    }

    public function getDateTimeScheduled( Request $req ){
      $appointments = Appointment::where('appointmentDate', '=', $req->theDate)->get();
      $timeForDate = array();
      foreach ($appointments as $key => $appointment) {
        $innerArray = array();
        $innerArray['time'] = $appointment->appointmentTime;
        $innerArray['range'] = $appointment->dateRange;
        $innerArray['isDefault'] = false;
        $innerArray['content'] = $appointment->appointmentName;
        array_push($timeForDate, $innerArray);
      }
      echo json_encode($timeForDate);
    }
    public function AppoinmentDateStep(Request $req){
      $validated = $req->validate([
        'serviceAmount' => 'required',
        'serviceDuration' => 'required',
        'serviceName' => 'required',
        'doctorId' => 'required',
        'services' => 'required',
        'timeChoosen' => 'required'
      ]);
      return view('admin.content.book3', [
        'serviceAmount' => $validated->serviceAmount,
        'serviceDuration' => $validated->serviceDuration,
        'serviceName' => $validated->serviceName,
        'doctorId' => $validated->doctorId,
        'services' => $validated->services,
        'timeChoosen' => $validated->timeChoosen
      ]);
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\doctor;
use App\Models\Users;
use App\Models\Services;
use App\Models\doctorNservices;

class doctorController extends Controller
{
  public function addDoctorAction(Request $req){
    $validated = $req->validate([
      'firstName' => 'required',
      'lastName' => 'required',
      'gender' => 'required',
      'age' => 'required',
      'birthDate' => 'required|date_format:Y-m-d',
      'phone' => 'required',
      'email' => 'required|unique:doctors',
      'zip' => 'required',
      'street' => 'required',
      'barangay' => 'required',
      'municipality' => 'required',
      'province' => 'required',
      'services' => 'required'
    ]);

    $id = DB::table('doctors')-> insertGetId(array(
      'firstName' => $validated['firstName'],
      'lastName' => $validated['lastName'],
      'gender' => $validated['gender'],
      'age' => $validated['age'],
      'birthDate' => $validated['birthDate'],
      'phoneNumber' => $validated['phone'],
      'email' => $validated['email'],
      'zip' => $validated['zip'],
      'street' => $validated['street'],
      'barangay' => $validated['barangay'],
      'municipality' => $validated['municipality'],
      'province' => $validated['province'],
      'services' => ''
      ));
      if ($id != null) {
        $dataTobe = [];
        foreach ($req->services as $key => $sevice) {
          $mainData = array();
          $mainData['doctor_id'] = $id;
          $mainData['service_id'] = $sevice;
          array_push($dataTobe, $mainData);
        }
        $actionAdd = doctorNservices::insert($dataTobe);
        if ($actionAdd) {
          return back()->with('ActionMsg', 'Doctor Successfully created');
        }else{
          dd('Something went wrong!');
        }
      }
  }

  public function editDoctor(Doctor $doctor){
    $data = Users::where('id', '=', Session('adminId'))->first();
    $serices = services::all();

    $doctorNservices = doctorNservices::Where('doctor_id', '=', $doctor->id)->get();
    $servicesOfDoc = [];
    foreach ($doctorNservices as $key => $value) {
      array_push($servicesOfDoc, $value->service_id);
    }

    return view('admin.content.edit-doctors', ['userLogged' => $data, 'services' => $serices, 'doctor' => $doctor, 'servicesOfDoc' => $servicesOfDoc]);

  }

  public function editDoctorAction(Request $req){
    $validated = $req->validate([
      'firstName' => 'required',
      'lastName' => 'required',
      'gender' => 'required',
      'age' => 'required',
      'birthDate' => 'required',
      'phone' => 'required',
      'email' => 'required|email|unique:doctors,email,'.$req->id,
      'zip' => 'required',
      'street' => 'required',
      'barangay' => 'required',
      'municipality' => 'required',
      'province' => 'required',
      'services' => 'required'
    ]);

    $execute = Doctor::Where('id', $req->id)
                ->update(array(
                  'firstName' => $validated['firstName'],
                  'lastName' => $validated['lastName'],
                  'gender' => $validated['gender'],
                  'age' => $validated['age'],
                  'birthDate' => $validated['birthDate'],
                  'phoneNumber' => $validated['phone'],
                  'email' => $validated['email'],
                  'zip' => $validated['zip'],
                  'street' => $validated['street'],
                  'barangay' => $validated['barangay'],
                  'municipality' => $validated['municipality'],
                  'province' => $validated['province'],
                  'services' => '',
                  'id' => $req->id
                ));
    if ($execute) {
      return back()->with('ActionMsg', 'Doctor updated');
    }else {
      dd('500, Internal server error');
    }

    // TODO: save the changes for services

  }

  public function deleteDoctor(Doctor $doctor){
    $executed = $doctor->delete();
    // dd($executed);
    if ($executed) {
      return back()->with(['ActionMsg'=>'Deleted']);
    }else{
      die('Something went wrong!');
    }


    // TODO: Delete doctor's related services
  }


}

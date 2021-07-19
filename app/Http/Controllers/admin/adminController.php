<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\Services;
use Illuminate\Support\Facades\Hash;
use App\Models\doctor;
use App\Models\doctorNservices;

class adminController extends Controller
{
    public function login(){
      return view('admin.login');
    }

    public function dasboard(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.dashboard', ['userLogged' => $data]);
    }

    public function reports(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.reports', ['userLogged' => $data]);
    }

    public function chat(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.chats', ['userLogged' => $data]);
    }

    public function services(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      $services = services::all();
      return view('admin.content.services', ['userLogged' => $data, 'services' => $services]);
    }

    public function addServices(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.add-services', ['userLogged' => $data]);
    }

    public function doctors(){

      $data = Users::where('id', '=', Session('adminId'))->first();
      $doctorNservices = doctorNservices::all();
      $doctors = doctor::all();
      $services = services::all();

      $servicesArray = array();
      foreach ($services as $key => $service) {
        $servicesArray[$service->id] = $service->name;
      }

      $doctorsServiceArray = array();
      foreach ($doctorNservices as $key => $doctorNservice) {


        if (array_key_exists( $doctorNservice->doctor_id, $doctorsServiceArray )) {
          array_push($doctorsServiceArray[$doctorNservice->doctor_id], $servicesArray[$doctorNservice->service_id]);
        }else{
          $doctorsServiceArray[$doctorNservice->doctor_id] = [$servicesArray[$doctorNservice->service_id]];
        }

      }
      // dd($doctorsServiceArray);
      return view('admin.content.doctors', ['userLogged' => $data, 'doctors' => $doctors, 'doctorsWithServices' => $doctorsServiceArray]);
    }


    public function addDoctors(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      $serices = services::all();
      return view('admin.content.add-doctors', ['userLogged' => $data, 'services' => $serices]);

    }


    public function onlinePatients(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.online-patients', ['userLogged' => $data]);
    }

    public function walkIn(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      $allWalkins = Users::where('type', '=', '2')->get();
      // dd( $allWalkins );
      return view('admin.content.walkin-patients', ['userLogged' => $data, 'allWalkins' => $allWalkins]);
    }

    public function addWalkIn(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.add-walkin', ['userLogged' => $data]);
    }

    public function appointmentToday(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.todays-appointment', ['userLogged' => $data]);
    }

    public function appointmentCalendar(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.appointment-calendar', ['userLogged' => $data]);
    }

    public function payment(){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.payment', ['userLogged' => $data]);
    }

    public function logout(){
      if (session()->has('adminId')) {
        session()->pull('adminId');
        return redirect('admin/login');
      }
    }

    public function loginAction( Request $req ){

      $validated = $req->validate([
        'username' => 'Required',
        'password' => 'Required'
      ]);

      $userInfo = Users::where(['username' => $validated['username'], 'type' => '0'])->first();

      if (!$userInfo) {
        return back()->with('usernameError', 'No account associated with this username');
      }else{
        if (Hash::check($validated['password'], $userInfo->password)) {
          $req->session()->put('adminId', $userInfo->id);
          return redirect('admin/dashboard');
        }else{
          return back()->with(['passwordError'=>'Invalid password', 'username'=>$validated['username']]);
        }
      }
    }


    public function addServiceAction( Request $req ){
      $validated = $req->validate([
        'name'      => 'required|unique:services',
        'fee'       => 'required|integer',
        'duration'  => 'required|date_format:H:i'
      ]);

      $saveData = services::create([
        'name' => $validated['name'],
        'amount' => $validated['fee'],
        'duration' => $validated['duration']
      ]);

      if ($saveData) {
        return back()->with(['ServiceActionMsg'=>'Service created!']);
      }else{
        die('Something went wrong');
      }

    }

    public function deleteServices(Services $service){
      $executed = $service->delete();
      // dd($executed);
      if ($executed) {
        return back()->with(['ServiceActionMsg'=>'Deleted']);
      }else{
        die('Something went wrong!');
      }
    }

    public function editServices(Services $service){
      $data = Users::where('id', '=', Session('adminId'))->first();
      return view('admin.content.edit-services', ['userLogged' => $data, 'serviceRecord' => $service]);

    }

    public function updateServiceAction(Request $req){
      // dd($req);
      $validated = $req->validate([
        'name'      => 'required|unique:services,name,' . $req->id,
        'fee'       => 'required|integer',
        'duration'  => 'required|date_format:H:i'
      ]);

      $executed = Services::where('id', $req->id)
                          ->update([
                            'name' => $validated['name'],
                            'amount' => $validated['fee'],
                            'duration' => $validated['duration']
                          ]);
      if ($executed) {
        return back()->with(['ServiceActionMsg'=>'Updated']);
      }else{
        dd('Something went wrong!');
      }
    }

}

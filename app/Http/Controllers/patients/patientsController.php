<?php

namespace App\Http\Controllers\patients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class patientsController extends Controller
{
    //
    public function register(){
      return view('patients.register');
    }

    public function login(){
      return view('patients.login');
    }
    public function forgotPass(){
      return view('patients.forgot');
    }
    public function logout(){
      if (session()->has('patientId')) {
        session()->pull('patientId');
        return redirect('patient/login');
      }
    }
    public function dashboard(){
      // dd(Session('patientId'));
      $data = Users::where('id', '=', Session('patientId'))->first();

      return view('patients.content.dashboard', ['userLogged' => $data]);
    }
    public function registerAction ( Request $req ){

      $req->validate([
        'firstname'       => 'required',
        'middlename'      => 'required',
        'lastname'        => 'required',
        'zip'             => 'required',
        'street'          => 'required',
        'barangay'        => 'required',
        'municipality'    => 'required',
        'province'        => 'required',
        'age'             => 'required',
        'birthDate'       => 'required|date_format:Y-m-d',
        'mobile'          => 'required',
        'gender'          => 'required',
        'email'           => 'required|email|unique:users',
        'password'        => 'required|min:6|max:18',
        'retypePassword'  => 'required'
      ]);

      if ($req->retypePassword != $req->password) {

        return back()->with([
          'failPassConfirm'   => 'Password confirmation is incorrect!',
          'firstname'         => $req->firstname,
          'middlename'        => $req->middlename,
          'lastname'          => $req->lastname,
          'zip'               => $req->zip,
          'street'            => $req->street,
          'barangay'          => $req->barangay,
          'municipality'      => $req->municipality,
          'province'          => $req->province,
          'age'               => $req->age,
          'birthDate'         => $req->birthDate,
          'mobile'            => $req->mobile,
          'email'             => $req->email
        ]);

      }

      $Users = new Users;

      $Users->firstName       = $req->firstname;
      $Users->lastName        = $req->lastname;
      $Users->middleName      = $req->middlename;
      $Users->street          = $req->street;
      $Users->barangay        = $req->barangay;
      $Users->zip             = $req->zip;
      $Users->city            = $req->municipality;
      $Users->province        = $req->province;
      $Users->Phone           = $req->mobile;
      $Users->gender          = $req->gender;
      $Users->profile         = 'Sample';
      $Users->age             = $req->age;
      $Users->dateOfBirth     = $req->birthDate;
      $Users->medicalHistory  = $req->medicalHistory;
      $Users->username        = $req->email;
      $Users->type            = '1';
      $Users->email           = $req->email;
      $Users->password        = Hash::make($req->password);

      if ($Users->save()) {
        $data = Users::where('username', '=', $req->email, 'AND', 'password', '=', Hash::make($req->password))->first();
        $req->session()->put('patientId', $data->id);
        return redirect('/patient/dashboard');
      }else{
        return back()->with('failRegistration', 'Something went, Please try again!');
      }

    }

    public function loginAction(Request $req){
      $validated = $req->validate([
        'username' => 'required',
        'password' => 'required'
      ]);
      // dd($validated);
      $userInfo = Users::where(['username' => $validated['username'], 'type' => '1'])->first();
      if (!$userInfo) {
        return back()->with('usernameError', 'No account associated with this username');
      }else{
        if (Hash::check($validated['password'], $userInfo->password)) {
          $req->session()->put('patientId', $userInfo->id);
          return redirect('patient/dashboard');
        }else{
          return back()->with(['passwordError'=>'Invalid password','username'=>$validated['username']]);
        }
      }
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;

class adminPatientsCtrl extends Controller
{
    public function addWalkinAction( Request $req ){

      $validated = $req->validate([
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'zip' => 'required|integer',
        'street' => 'required',
        'barangay' => 'required',
        'municipality' => 'required',
        'province' => 'required',
        'age' => 'required|integer',
        'birthDate' => 'required|date_format:Y-m-d',
        'mobile' => 'required|integer',
        'gender' => 'required',
        'email' => 'required|email|unique:users'
      ]);

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
      $Users->type            = '2';
      $Users->email           = $req->email;
      $Users->password        = '';


      if ($Users->save()) {
        return back()->with('ActionMsg', 'Walki-in patients created');
      }else{
        dd('500: Internal server error');
      }
    }

    public function editWalkin( Users $patient ){
      $data = Users::where('id', '=', Session('adminId'))->first();

      return view('admin.content.edit-walkin', ['userLogged' => $data, 'patient' => $patient]);
    }

    public function editWalkinAction( Request $req ){
      $validated = $req->validate([
        'firstname' => 'required',
        'middlename' => 'required',
        'lastname' => 'required',
        'zip' => 'required|integer',
        'street' => 'required',
        'email' => 'required|email|unique:doctors,email,'.$req->id,
        'barangay' => 'required',
        'municipality' => 'required',
        'province' => 'required',
        'age' => 'required|integer',
        'birthDate' => 'required|date_format:Y-m-d',
        'mobile' => 'required|integer',
        'gender' => 'required'
      ]);

      $execute = Users::where('id', '=', $req->id)
                      ->update([
                        'firstName' => $validated['firstname'],
                        'lastName'  => $validated['lastname'],
                        'middleName'  => $validated['middlename'],
                        'street'  => $validated['street'],
                        'barangay'  => $validated['barangay'],
                        'zip' => $validated['zip'],
                        'city'  => $validated['municipality'],
                        'province'  => $validated['province'],
                        'Phone' => $validated['mobile'],
                        'gender'  => $validated['gender'],
                        'age' => $validated['age'],
                        'dateOfBirth' => $validated['birthDate'],
                        'email' => $validated['email']
                      ]);

      if ($execute) {
        return back()->with('ActionMsg', 'Patient Updated');
      }else{
        dd('500: internal server error');
      }
    }
    public function deleteWalkin(Users $patient){
      $execute = $patient->delete();
      if ($execute) {
        return back()->with('ActionMsg', 'Patient deleted');
      }else{
        dd('500: Internal server error');
      }
    }
}

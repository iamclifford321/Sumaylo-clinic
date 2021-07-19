<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Patients\registerPatient;
use App\Http\Controllers\patients\patientsController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\doctorController;
use App\Http\Controllers\admin\adminPatientsCtrl;
use App\Http\Controllers\admin\bookAppointmentAdminCtrl;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('patients.login');
});

// Patients
Route::get('/patient/register', [patientsController::class, 'register'])->name('patients.register');
Route::get('/patient/login', [patientsController::class, 'login'])->name('patients.login');
Route::get('/patient/forgot', [patientsController::class, 'forgotPass'])->name('patients.forgot');
Route::post('/patient/registerAction', [patientsController::class, 'registerAction'])->name('patients.registerAction');
Route::post('/patient/loginAction', [patientsController::class, 'loginAction'])->name('patients.loginAction');


// Admin

Route::get('/admin/login', [adminController::class, 'login'])->name('admin.login');
Route::post('/admin/loginAction', [adminController::class, 'loginAction'])->name('admin.loginAction');

Route::group(['middleware' => ['isAdmin']], function(){

  Route::get('/admin/dashboard', [adminController::class, 'dasboard'])->name('admin.dasboard');
  Route::get('/admin/Reports', [adminController::class, 'reports'])->name('admin.reports');
  Route::get('/admin/chat', [adminController::class, 'chat'])->name('admin.chat');
  Route::get('/admin/services', [adminController::class, 'services'])->name('admin.services');
  Route::get('/admin/addServices', [adminController::class, 'addServices'])->name('admin.addServices');
  Route::get('/admin/doctors', [adminController::class, 'doctors'])->name('admin.doctors');
  Route::get('/admin/addDoctors', [adminController::class, 'addDoctors'])->name('admin.addDoctors');
  Route::get('/admin/onlinePatients', [adminController::class, 'onlinePatients'])->name('admin.onlinePatients');
  Route::get('/admin/walkIn', [adminController::class, 'walkIn'])->name('admin.walkIn');
  Route::get('/admin/addWalkIn', [adminController::class, 'addWalkIn'])->name('admin.addWalkIn');
  Route::get('/admin/appointmentToday', [adminController::class, 'appointmentToday'])->name('admin.appointmentToday');
  Route::get('/admin/appointmentCalendar', [adminController::class, 'appointmentCalendar'])->name('admin.appointmentCalendar');
  Route::get('/admin/payment', [adminController::class, 'payment'])->name('admin.payment');

  Route::get('/admin/services/delete/{service}', [adminController::class, 'deleteServices']);
  Route::get('/admin/services/{service}', [adminController::class, 'editServices']);
  Route::patch('/admin/services/editAction', [adminController::class, 'updateServiceAction'])->name('admin.updateServiceAction');
  Route::post('/admin/addServiceAction', [adminController::class, 'addServiceAction'])->name('admin.addServiceAction');

  Route::get('/admin/doctor/edit/{doctor}', [doctorController::class, 'editDoctor']);
  Route::get('/admin/doctor/delete/{doctor}', [doctorController::class, 'deleteDoctor']);
  Route::post('/admin/doctor/editDoctorAction', [doctorController::class, 'editDoctorAction'])->name('admin.editDoctorAction');
  Route::post('/admin/doctor/addDoctorAction', [doctorController::class, 'addDoctorAction'])->name('admin.addDoctorAction');


  Route::get('/admin/logout', [adminController::class, 'logout'])->name('admin.logout');

  Route::post('/admin/walkin/addWalkinAction', [adminPatientsCtrl::class, 'addWalkinAction'])->name('admin.addWalkinAction');
  Route::post('/admin/walkin/editWalkinAction', [adminPatientsCtrl::class, 'editWalkinAction'])->name('admin.editWalkinAction');
  Route::get('/admin/walkin/edit/{patient}', [adminPatientsCtrl::class, 'editWalkin']);
  Route::get('/admin/walkin/delete/{patient}', [adminPatientsCtrl::class, 'deleteWalkin']);

  Route::get('/admin/walkin/book', [bookAppointmentAdminCtrl::class, 'bookAppointmentWalkIn'])->name('admin.bookAppointmentWalkIn');
  Route::post('/admin/walkin/getDoctorNService', [bookAppointmentAdminCtrl::class, 'getDoctorNService'])->name('admin.getDoctorNService');

  Route::post('/admin/walkin/registerServiceAndDoctorWalkin', [bookAppointmentAdminCtrl::class, 'registerServiceAndDoctorWalkin'])->name('admin.registerServiceAndDoctorWalkin');

  Route::post('/admin/walkin/getDateTimeScheduled', [bookAppointmentAdminCtrl::class, 'getDateTimeScheduled'])->name('admin.getDateTimeScheduled');

  Route::post('/admin/walkin/AppoinmentDateStep', [bookAppointmentAdminCtrl::class, 'AppoinmentDateStep'])->name('admin.AppoinmentDateStep');






});

Route::group(['middleware' => ['isPatient']], function(){

  Route::get('/patient/logout', [patientsController::class, 'logout'])->name('patients.logout');
  Route::get('/patient/dashboard', [patientsController::class, 'dashboard'])->name('patients.dashboard');

});

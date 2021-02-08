<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::post('/login', [App\Http\Controllers\API\LoginController::class, 'authenticate']);


//Route::get('/patient/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('patientlogin.show');
Route::post('/patient/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate']);
Route::get('/patient', [App\Http\Controllers\Patient\PatientController::class, 'index']);
Route::get('/patient/appointment', [App\Http\Controllers\Patient\PatientController::class, 'showAppointmentPage']);
Route::post('/patient/appointment/{id}', [App\Http\Controllers\Patient\PatientController::class, 'bookAppointment'])->name('patient.appointment.save');
Route::post('/patient/appointment/delete/{id}', [App\Http\Controllers\Patient\PatientController::class, 'cancelBookAppointment'])->name('patient.appointment.delete');
Route::get('/patient/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('patient.logout');

Route::get('/doctor/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'login'])->name('doctorlogin.show');
Route::post('/doctor/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'authenticate'])->name('doctor.login');
Route::get('/doctor/logout', [App\Http\Controllers\Auth\DoctorLoginController::class, 'logout'])->name('doctor.logout');
Route::get('/doctor/appointment', [App\Http\Controllers\Doctor\DoctorController::class, 'showAppointmentForm'])->name('doctor.appointment');
Route::post('/doctor/appointment/save', [App\Http\Controllers\Doctor\DoctorController::class, 'createAppointment'])->name('doctor.appointment.save');
Route::post('/doctor/appointment/delete/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'deleteAppointment'])->name('doctor.appointment.delete');
Route::get('/doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('doctor.dashboard');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');


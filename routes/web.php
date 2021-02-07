<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

//Auth::routes();

Route::get('/patient/login', [App\Http\Controllers\Auth\LoginController::class, 'login'])->name('patientlogin.show');
Route::post('/patient/login', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('parent.login');

Route::get('/doctor/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'login'])->name('doctorlogin.show');
Route::post('/doctor/login', [App\Http\Controllers\Auth\DoctorLoginController::class, 'authenticate'])->name('doctor.login');
Route::get('/doctor/logout', [App\Http\Controllers\Auth\DoctorLoginController::class, 'logout'])->name('doctor.logout');
Route::get('/doctor/appointment', [App\Http\Controllers\Doctor\DoctorController::class, 'showAppointmentForm'])->name('doctor.appointment');
Route::post('/doctor/appointment/save', [App\Http\Controllers\Doctor\DoctorController::class, 'createAppointment'])->name('doctor.appointment.save');
Route::post('/doctor/appointment/delete/{id}', [App\Http\Controllers\Doctor\DoctorController::class, 'deleteAppointment'])->name('doctor.appointment.delete');

Route::get('/patient', [App\Http\Controllers\Patient\PatientController::class, 'index'])->name('patient.dashboard');
Route::get('/doctor', [App\Http\Controllers\Doctor\DoctorController::class, 'index'])->name('doctor.dashboard');

Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegisterForm']);
Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



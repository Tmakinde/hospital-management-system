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


Route::post('/patient/login', [App\Http\Controllers\API\LoginController::class, 'authenticate']);
Route::get('/patient/appointment', [App\Http\Controllers\API\PatientController::class, 'showAppointmentPage']);
Route::post('/patient/', [App\Http\Controllers\API\PatientController::class, 'showUser']);
Route::post('/patient/appointment/{id}', [App\Http\Controllers\API\PatientController::class, 'bookAppointment']);
Route::post('/patient/appointment/delete/{id}', [App\Http\Controllers\API\PatientController::class, 'cancelBookAppointment']);
Route::get('/patient/logout', [App\Http\Controllers\API\LoginController::class, 'logout'])->name('patient.logout');

Route::post('/doctor/login', [App\Http\Controllers\API\DoctorLoginController::class, 'authenticate']);
Route::get('/doctor/', [App\Http\Controllers\API\DoctorController::class, 'showUser']);
Route::get('/doctor/logout', [App\Http\Controllers\API\DoctorLoginController::class, 'logout']);
Route::post('/doctor/appointment/save', [App\Http\Controllers\API\DoctorController::class, 'createAppointment']);
Route::post('/doctor/appointment/delete/{id}', [App\Http\Controllers\API\DoctorController::class, 'deleteAppointment']);

Route::post('/register', [App\Http\Controllers\API\RegisterController::class, 'register']);


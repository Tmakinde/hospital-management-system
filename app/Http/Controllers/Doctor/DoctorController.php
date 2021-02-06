<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Appointment;
use Auth;
class DoctorController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('DoctorMiddleware:api');
    }

    public function index(){
        return view('Dashboard');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function showAppointmentForm(){
        return view('Doctor.Appointment');
    }

    public function createAppointment(Request $request){

        $user = Auth::user();
        $timeslot = $request->appointment;
        $appointment  = new Appointment;
        $appointment  = $timeslot;
        $appointment->doctor_id = $user->id;
        $appointment->save();
        return redirect()->back()->with(['message' => 'Appointment Created Successfully']);

    }

    public function deleteAppointment(Request $request, $id){
        $appointment  = Appointment::whereId($id)
                        ->where('doctor_id', $this->currentUser()->id)
                        ->firstOrFail();

        $appointment->delete();
        return redirect()->back()->with(['message' => 'Appointment Deleted Successfully']);
    }

    public function displaySelfAppointment(Request $request){

        $appointment  = Appointment::where('doctor_id', $this->currentUser()->id)->get();
        return view('Doctor.myAppointment', compact('appointment'));

    }



}

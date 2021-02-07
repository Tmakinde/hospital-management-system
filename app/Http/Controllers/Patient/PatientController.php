<?php

namespace App\Http\Controllers\Patient;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Appointment;
use Auth;

class PatientController extends Controller
{
    public function __construct(){
        return $this->middleware('auth:api');
    }
    public function index(){
        return view('Patient.dashboard');
    }
    public function currentUser(){
        return Auth::user();
    }
    public function showAppointmentPage(){
        return view('Doctor.Appointment');
    }

    public function bookAppointment(Request $request, $id){

        $appointment  = Appointment::whereId($id)->firstOrFail();
        $allAppointment = Appointment::all();
        $checker = false;

        foreach ($allAppointment as $app) {

            if($app->patient_id == $this->currentUser()->id){
                $checker = true;
                break;
            }

        }
        if (!$checker) {

            if($appointment->patient_id != null){

                $appointment->patient_id = $this->currentUser()->id;
                $appointment->save();
                return redirect()->back()->with([
                    'message' => 'Your Appointment has been booked'
                ]);
    
            }
            return redirect()->back()->with(['message' => 'Oh! Appointment has been booked by another Patient or ']);

        }
        return redirect()->back()->with(['message' => 'You cannot have more than one appointment']);

    }

    public function displaySelfBookAppointment(Request $request){

        $appointment  = Appointment::where('patient_id', $this->currentUser()->id)->first();
        return view('Patient.myAppointment', compact('appointment'));

    }

    public function displayAppointments(Request $request){

        $appointment  = Appointment::where('patient_id', null)->get();
        return view('Patient.allAppointment', compact('appointment'));

    }

    public function cancelBookAppointment(Request $request, $id){
        $appointment  = Appointment::whereId($id)->firstOrFail();

        if($appointment->patient_id == $this->currentUser()->id){
            $appointment->patient_id = null;
            $appointment->save();
            return redirect()->back()->with([
                'message' => 'Your Appointment has beem canceled'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'You are not authorize to cancel appointment!'
        ]);

    }

}

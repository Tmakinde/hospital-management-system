<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Appointment;
use Mail;
use Auth;
//
class DoctorController extends Controller
{
    //
    public function __construct(){
    return $this->middleware('auth:doctors');
    }

    public function index(){
        return view('Doctor.dashboard');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function showAppointmentForm(){
        $appointments  = Appointment::where('doctor_id', $this->currentUser()->id)->get();
        return view('Doctor.Appointment', compact('appointments'));
    }

    public function createAppointment(Request $request){
        $user = Auth::user();
        $timeslot = $request->appointment;
        $query = Appointment::where('doctor_id', $this->currentUser()->id)->get();
        $checker = false;

        foreach ($query as $key) {
            
            if ($key->appointment == $timeslot) {
                $checker = true;
                break;
            }
        }
        if (!$checker) {
            
            $appointment  = new Appointment;
            $appointment->appointment  = $timeslot;
            $appointment->doctor_id = $user->id;
            $appointment->max = $request->max;
            $appointment->save();
            return redirect()->route('doctor.appointment')->with(['message' => 'Appointment Created Successfully']);
            
        }
        return response()->json([
            'message' => 'Oh! You have a appointment for this already'
        ], 200);

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

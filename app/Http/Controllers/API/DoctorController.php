<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role;
use App\Models\Doctor;
use App\Models\Appointment;
use Mail;
use Auth;
//
class DoctorController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('auth:doctorAPI');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function getDoctorPatients(){
        $query = Appointment::where('doctor_id', $this->currentUser()->id)->get();
        $array = [];
        
        foreach ($query as $key) {
            $array[] = $key->users;
        }
        
        return response()->json([
            'Appointment List' => $array,
        ], 200);

    }

    public function showUser(){
        return response()->json([
            'doctor'=> $this->currentUser(),
        ], 200);
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
            $appointment->doctor_id = $this->currentUser()->id;
            $appointment->max = $request->max;
            $appointment->save();
           
            return response()->json([
                'message' => 'Appointment Created Successfully'
            ], 200);
            
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
       
        return response()->json([
                'message' => 'Appointment Deleted Successfully'
            ], 200);
      
    }


}

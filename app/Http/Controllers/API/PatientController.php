<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointUser;
use Mail;
use Auth;

class PatientController extends Controller
{
    public function __construct(){
        return $this->middleware('guest:userAPI');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function showUser(){
        return response()->json([
            'Patient'=> $this->currentUser(),
        ], 200);
    }

    public function showAppointmentPage(Request $request){

        $appointment = $this->currentUser()->appointments;
        $appointment = Appointment::where('id', $appointment->appointment_id)->first();
        $availableAppointments = Appointment::all();

        return response()->json([
            'My appointment' => $appointment,
            'Doctors Appointments' => $availableAppointments,
        ], 200);
        
    }

    public function bookAppointment(Request $request, $id){

        $appointment  = Appointment::whereId($id)->firstOrFail();

        $patientMail = $this->currentUser()->email;

        $patientName =  $this->currentUser()->name;

        $doctor = Doctor::whereId($appointment->doctor_id)->first();

        $doctorMail = $doctor->email;

        $allAppointment = Appointment::all();

        $checker = $this->currentUser()->appointments;

        $countRemainSlotUsed = $appointment->appointmentUser->count();

        $Max = $appointment->max;

        $appointment  = Appointment::whereId($id)->firstOrFail();
        if ($checker == null) {

            if($countRemainSlotUsed <= $Max){

                $booking = new AppointUser;
                $booking->appointment_id = $appointment->id;
                $booking->user_id = $this->currentUser()->id;
                $booking->save();

                $data = compact('doctorMail', 'patientName', 'patientMail');

                return redirect()->back()->with([
                    'message' => 'Your Appointment has been booked'
                ]);
            }
            return response()->json([
                'message' => 'Oh! Appointment has been booked by another Patient'
            ], 200);

        }
       
        return response()->json([
            'message' => 'You cannot have more than one appointment'
        ], 403);
       

    }

    public function cancelBookAppointment(Request $request, $id){
        $appointment  = Appointment::whereId($id)->firstOrFail();
        $patientMail = $this->currentUser()->email;
        $patientName =  $this->currentUser()->name;
        $doctorMail = Doctor::whereId($appointment->doctor_id)->first();

        if($this->currentUser()->appointments != null){
            $this->currentUser()->appointments->delete();
            $data = compact('doctorMail', 'patientName', 'patientMail');
            
            return response()->json([
                'message' => 'Your Appointment has been canceled'
            ], 200);
            
        }

        return response()->json([
            'message' => 'You are not authorize to cancel appointment!'
        ], 200);


    }

}

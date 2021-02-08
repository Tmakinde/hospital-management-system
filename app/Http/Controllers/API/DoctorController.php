<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Appointment;
use App\Models\AppointUser;
use Auth;
use Mail;

class DoctorController extends Controller
{
    public function __construct(){
        return $this->middleware('auth')->except('index');
    }
    
    public function index(){
        return view('Patient.dashboard');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function showAppointmentPageView(Request $request){
        
        return view('Patient.Appointment');
        
    }

    public function showAppointmentPage(Request $request){

        $appointment = $this->currentUser()->appointments;
        $availableAppointments = Appointment::all();

        return response()->json([
            'appointment' => $appointment,
            'availableAppointments' => $availableAppointments,
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
            return redirect()->back()->with(['message' => 'Oh! Appointment has been booked by another Patient']);

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
        $patientMail = $this->currentUser()->email;
        $patientName =  $this->currentUser()->name;
        $doctorMail = Doctor::whereId($appointment->doctor_id)->first();

        if($this->currentUser()->appointments != null){
            $this->currentUser()->appointments->delete();
            $data = compact('doctorMail', 'patientName', 'patientMail');

            return redirect()->back()->with([
                'message' => 'Your Appointment has been canceled'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'You are not authorize to cancel appointment!'
        ]);

    }

}

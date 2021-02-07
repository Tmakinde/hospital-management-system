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
        return $this->middleware('auth');
    }
    public function index(){
        return view('Patient.dashboard');
    }

    public function currentUser(){
        return Auth::user();
    }

    public function showAppointmentPage(Request $request){

        $appointment = $this->currentUser()->appointments;
        $availableAppointments = Appointment::with('doctors')->where('user_id', null)->get();
        //dd($availableAppointments);
        return view('Patient.Appointment', compact('appointment','availableAppointments'));
        ///
    }

    public function bookAppointment(Request $request, $id){

        $appointment  = Appointment::whereId($id)->firstOrFail();
        $patientMail = $this->currentUser()->email;
        $patientName =  $this->currentUser()->name;
        $doctorMail = Doctor::whereId($appointment->doctor_id)->first();
        $allAppointment = Appointment::all();
        $checker = false;

        foreach ($allAppointment as $app) {

            if($app->user_id == $this->currentUser()->id){
                $checker = true;
                break;
            }

        }
        if (!$checker) {

            if($appointment->user_id == null){
                $appointment->user_id = $this->currentUser()->id;
                $appointment->save();
                $data = compact('doctorMail', 'patientName', 'patientMail');

                Mail::send(
                    'Mail.Appointment',
                    $data,
                    function ($m) use ($data) {
                    $m->to($data['doctorMail'])->subject('Notification Message From'.env('APP_NAME'));
                });

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

        if($appointment->user_id == $this->currentUser()->id){
            $appointment->user_id = null;
            $appointment->save();
            $data = compact('doctorMail', 'patientName', 'patientMail');

            Mail::send(
                'Mail.Appointment',
                $data,
                function ($m) use ($data) {
                $m->to($data['doctorMail'])->subject('Notification Message From'.env('APP_NAME'));
            });

            return redirect()->back()->with([
                'message' => 'Your Appointment has been canceled'
            ]);
        }

        return redirect()->back()->with([
            'message' => 'You are not authorize to cancel appointment!'
        ]);

    }

}

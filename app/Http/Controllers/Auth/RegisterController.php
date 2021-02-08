<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;
use Mail;
use App\Models\Doctor;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [

            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string',],
            'dob' => ['required', 'string'],
            'phone' => ['required', 'string'],
            'address' => ['required', 'string'],

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function createPatient(array $data, Request $request)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);

    }

    protected function createDoctor(array $data, Request $request)
    {

        return Doctor::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);

    }

    public function showRegisterForm(Request $request){

        return view('Register');

    }

    public function register(Request $request){
        $input = $request->all();
        $name =  $request->name;
        $email =  $request->email;
        $role = $request->role;
        $data = compact('name', 'email');
        $validator = $this->validator($input);

        if($validator->passes()){
            if($role == 'Doctor'){
                $this->createDoctor($input, $request);

                Mail::send(
                    'Mail.Registration',
                    $data,
                    function ($m) use ($data) {
                    $m->to($data['email'])->subject('Notification Message From'.env('APP_NAME'));
                });
                
                return redirect()->route('doctorlogin.show');
            }elseif ($role == 'Patient') {
                $this->createPatient($input, $request);

                Mail::send(
                    'Mail.Registration',
                    $data,
                    function ($m) use ($data) {
                    $m->to($data['email'])->subject('Notification Message From'.env('APP_NAME'));
                });

                return redirect()->route('patientlogin.show');
            }
        }

        return redirect()->back()->withInput()->withErrors($validator);
    }
}

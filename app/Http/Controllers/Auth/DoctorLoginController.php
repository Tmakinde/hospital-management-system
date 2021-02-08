<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
class DoctorLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        return $this->middleware('guest:doctors')->except('logout');
    }

    public function login(Request $request){
        return view('Doctor.Login');
    }

    public function authenticate(Request $request){

        $credentials = $request->only('email', 'password');

        $user = User::where('email',$request->email)->first();
        if (Auth::guard('doctors')->attempt($credentials)) {
            
            return redirect()->intended(route('doctor.dashboard'));

        }
        return redirect()->back()->withInput()->withErrors('Incorrect Login Credentials');

    }

    public function logout(){
        Auth::logout();
        return redirect()->to(route('doctorlogin.show'));
    }
    
}

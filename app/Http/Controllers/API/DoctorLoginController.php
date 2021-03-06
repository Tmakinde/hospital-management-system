<?php

namespace App\Http\Controllers\API;

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
        $this->middleware('guest:doctorAPI')->except('logout');
    }

    public function login(Request $request){
        return view('Patient.Login');
    }

    public function authenticate(Request $request){

        $credentials = $request->only('email', 'password');
        if ($token = Auth::guard('doctorAPI')->attempt($credentials)) {
            
            return response()->json([
                'message' => 'User successfully signin',
                'token' => $token,

            ], 200);

        }
        return response()->json([
            'message' => 'Incorrect Login Credentials',
        ], 401);
    }

    public function logout(){
        Auth::logout();
        return response()->json([
            'message' => 'user successfully logout',
        ], 200);
    }
    
}

<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;

class LoginController extends Controller
{
    public function __construct(){
        return $this->middleware('guest:api')->except('logout');
    }

    public function authenticate(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if($validator->passes()){
            $email = $request->input('email');
            $user = User::where('email', $email)->first();
            $credentials = $request->only('password', 'email');

            if(auth()->attempt($credentials)){

                return response()->json([
                    'token' => auth()->login($user),
                ], 200);

            }

            return response()->json([
                'message' => "provide valid details",
            ], 401);
        }

        return response()->json([
            'message' => $validator->errors(),
        ], 401);
        
    }
}

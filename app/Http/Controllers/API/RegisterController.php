<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('guest:api');
    }

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

    protected function create(array $data, Request $request)
    {
        $role = Role::where('role', $request->role)->first();

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'dob' => $data['dob'],
            'role_id' => $role->id,
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);

    }

    public function register(Request $request){
        
        $input = $request->all();
        $name =  $request->name;
        $email =  $request->email;
        $data = compact('name', 'email');
        $validator = $this->validator($input);

        if($validator->passes()){
            $this->create($input, $request);

            Mail::send(
                'Mail.Registration',
                $data,
                function ($m) use ($data) {
                $m->to($data['email'])->subject('Notification Message From'.env('APP_NAME'));
            });

            return response()->json([
                'message' => 'User successfully register'
            ]);
        }

        return response()->json([
            'error' => $validator->errors(),
        ]);

    }
}

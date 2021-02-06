<?php

namespace App\Http\Controllers\Doctor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    //
    public function __construct(){
        return $this->middleware('DoctorMiddleware');
    }

    public function index(){
        return view('Dashboard');
    }
}

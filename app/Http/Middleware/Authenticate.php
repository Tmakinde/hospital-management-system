<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (\Request::is('doctor/*') || \Request::is('doctor')){
            return route('doctorlogin.show');
        }elseif (\Request::is('patient/*') || \Request::is('patient')) {
            return route('patientlogin.show');
        }
    }
}

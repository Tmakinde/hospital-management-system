<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Appointment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        view()->composer('*', function($view){
            $countAvailableAppointment = Appointment::where('user_id', null)->count();
            if (auth()->check()) {
                view()->share('countAvailableAppointment', $countAvailableAppointment);
            }
        });
    }
}

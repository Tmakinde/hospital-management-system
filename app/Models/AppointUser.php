<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointUser extends Model
{
    use HasFactory;
    protected $table = 'appointments_users';

    public function appoint(){
        return $this->belongsTo(Appointment::class);
    }

    public function users(){
        return $this->belongsTo(User::class, 'user_id');
    }

}

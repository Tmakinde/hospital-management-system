<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'doctor_id','user_id'
    ];

    public function doctors(){
        return $this->belongsTo(Doctor::class, 'doctor_id');
    }
    
    public function appointmentUser(){
        return $this->hasMany(AppointUser::class, 'appointment_id');
    }

}

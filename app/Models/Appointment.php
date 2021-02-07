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
        return $this->belongsTo(User::class);
    }

    public function users(){
        return $this->belongsTo(User::class);
    }

}

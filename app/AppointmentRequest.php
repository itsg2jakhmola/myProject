<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AppointmentRequest extends Model
{
    protected $table = 'appointment_request';

     protected $fillable = [
        'user_id', 'appointment_id', 'assign_to', 'assigned_name', 'lat', 'lng', 'distance', 'speciality', 'notes', 'appointment_time', 'seen', 'created_at', 'updated_at'
    ];

    public function users($local_key = 'user_id'){
    	return $this->belongsTo('App\User', $local_key, 'id');
    }

    public function prescription()
    {
    	return $this->hasOne(DoctorPrescription::class, 'appointment_id', 'appointment_id');
    }
}

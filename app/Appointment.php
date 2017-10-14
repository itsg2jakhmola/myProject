<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{

	protected $table = 'appointment';

     protected $fillable = [
       'user_id', 'request_to', 'doctor_speciality', 'notes', 'appointment_time',
    ];

    public function appointment_request()
    {
    	return $this->hasOne(AppointmentRequest::class, 'appointment_id');
    }

    public function prescriptions()
    {
    	return $this->hasOne(DoctorPrescription::class, 'appointment_id');
    }

    public function users()
    {
    	return $this->hasOne(User::class, 'id', 'request_to');
    }
}

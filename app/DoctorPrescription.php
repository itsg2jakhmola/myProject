<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DoctorPrescription extends Model
{
    protected $table = 'prescriptions';

     protected $fillable = [
        'to_pharmist', 'distance', 'lat', 'lng', 'for_patient', 'from_doctor', 'created_at', 'updated_at'
    ];

    public function users($local_key = 'user_id'){
    	return $this->belongsTo('App\User', $local_key, 'id');
    }

    public function doctor(){
    	return $this->belongsTo(User::class, 'from_doctor', 'id');
    }

    public function patient()
    {
    	return $this->belongsTo(User::class, 'for_patient', 'id');
    }

    public function pharmist()
    {
    	return $this->belongsTo(User::class, 'to_pharmist', 'id');
    }

    public function tracking()
    {
        return $this->hasOne(PharmaTracking::class, 'appointment_id', 'appointment_id');
    }

    public function booking_request()
    {
        return $this->hasOne(AppointmentRequest::class, 'appointment_id', 'appointment_id');       
    }
}

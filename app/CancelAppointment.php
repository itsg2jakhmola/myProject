<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CancelAppointment extends Model
{
    protected $table = 'cancel_appointment';

     protected $fillable = [
        'id', 'appointment_id', 'patient_id', 'cancel_by', 'created_at', 'updated_at'
    ];

    public function users($local_key = 'patient_id'){
    	return $this->belongsTo('App\User', $local_key, 'id');
    }
}

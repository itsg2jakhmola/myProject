<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmaTracking extends Model
{
    protected $table = 'tracking';

     protected $fillable = [
        'appointment_id', 'doctor_id', 'patient_id', 'amount', 'pack_time', 'packed_date', 'pharma_name', 'created_at', 'updated_at'
    ];
}

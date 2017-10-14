<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmistRequest extends Model
{
     protected $table = 'pharmist_request';

     protected $fillable = [
        'appointment_id', 'to_patient', 'to_doctor', 'alternate_prescription', 'lat', 'lng', 'distance', 'created_at', 'updated_at'
    ];

}

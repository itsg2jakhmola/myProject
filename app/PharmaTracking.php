<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmaTracking extends Model
{
    protected $table = 'tracking';

     protected $fillable = [
        'appointment_id', 'doctor_id', 'patient_id', 'amount', 'pack_time', 'packed_date', 'pharma_name', 'created_at', 'updated_at'
    ];

    public function doctor(){
    	return $this->belongsTo(User::class, 'doctor_id', 'id');
    }

    public function patient(){
        return $this->belongsTo(User::class, 'patient_id', 'id');
    }

    public function userReview()
    {
    	return $this->hasOne(UserRating::class, 'appointment_id', 'appointment_id');
    }
}

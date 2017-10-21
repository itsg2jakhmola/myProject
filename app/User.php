<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'middle_name', 'name', 'email', 'password', 'user_type', 'dob', 'medical_number', 'address', 'phone_number', 'doctor_practice', 'fax_number', 'lat', 'lng', 'about', 'insurance_number', 'insurance_company', 'remember_token',
    ];

    public function appointmentRequest(){
      return $this->hasMany(AppointmentRequest::class, 'user_id');
    }

    // Check if patient has nay default Pharmacy
    public function hasDefaultPharmacy(){
      if($default = $this->defaultPharmacy()){
        return $default->first()->assignedUser;
      }

      return false;
    }

    public function getDoctor(){
        return $this->hasOne('App\User', 'id', 'assign_to_doctor');
    }

    public function defaultPharmacy(){
      return $this->hasOne(DefaultUser::class, 'user_id')->with('assignedUser')->get();
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}

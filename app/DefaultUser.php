<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DefaultUser extends Model
{
    protected $table = 'default_user_assigned';

     protected $fillable = [
       'id', 'user_id', 'assign_to_doctor', 'assign_to_pharmist', 'created_at', 'updated_at'
    ];

    public function users($local_key = 'assign_to'){
    	return $this->belongsTo('App\User', $local_key, 'id');
    }

    public function assignedUser(){
    	return $this->belongsTo(User::class, 'assign_to_doctor');
    }

     public function assignedPharmacy(){
    	return $this->belongsTo(User::class, 'assign_to_pharmist');
    }
}

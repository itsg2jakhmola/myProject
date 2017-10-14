<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRating extends Model
{
     protected $table = 'user_ratings';

     protected $fillable = [
        'user_id', 'appointment_id', 'rating', 'review', 'created_at', 'updated_at'
    ];

}

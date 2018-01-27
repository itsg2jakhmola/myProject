<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alergichistory extends Model
{
     protected $table = 'alergy_history';

    protected $fillable = ['name', 'remarks', 'user_id',  'created_at', 'updated_at'];
}

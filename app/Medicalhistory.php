<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Medicalhistory extends Model
{
    protected $table = 'medical_history';

    protected $fillable = ['name', 'description', 'medical_scan', 'medical_scan_path', 'created_at', 'updated_at'];
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Medicalhistory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PatientMedicalHistory extends Controller
{
    public function show()
    {
    	$medical_detail = Medicalhistory::all();
        return view('admin.user.doctor_appointment.show_patient_medical_history', compact('medical_detail')); 
    }
}

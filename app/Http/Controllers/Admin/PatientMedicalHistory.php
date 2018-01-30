<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Medicalhistory;
use App\Alergichistory;
use App\Appointment;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class PatientMedicalHistory extends Controller
{
    public function show()
    {

    	$appointment = Appointment::where('request_to', Auth::user()->id)->get();

    	$medical_detail = '';
    	foreach ($appointment as $key => $value) {
    		# code...
    		 $medical_detail = Medicalhistory::where('user_id', $value->user_id)->get();
    	}

    	
        return view('admin.user.doctor_appointment.show_patient_medical_history', compact('medical_detail')); 
    }

    public function showAlergic()
    {

    	$appointment = Appointment::where('request_to', Auth::user()->id)->get();

    	$alergy_detail = '';
    	foreach ($appointment as $key => $value) {
    		# code...
    		 $alergy_detail = Alergichistory::where('user_id', $value->user_id)->get();
    	}

        return view('admin.user.doctor_appointment.show_patient_alergy_history', compact('alergy_detail')); 	
    }
}

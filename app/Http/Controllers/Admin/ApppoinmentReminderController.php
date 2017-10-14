<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\DoctorPrescription;
use App\Http\Controllers\Controller;

class ApppoinmentReminderController extends Controller
{
     public function index(){
     	$auth = Auth::user();
     	
     	$appointmentReminder = DoctorPrescription::where('from_doctor', $auth->id)->whereNotNull('set_reminder')->get();
     	
    	return view('admin.user.appoinment_reminder', compact('appointmentReminder'));
    }
}

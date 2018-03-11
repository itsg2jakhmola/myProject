<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\DoctorPrescription;
use App\PharmistRequest;
use App\PharmaTracking;

class AddPrescriptionController extends Controller
{
     public function index(){

     	$auth = Auth::user();
     	
            $prescription_list = PharmaTracking::where('user_id', $auth->id)->orderBy('created_at', 'DESC')->get()->load('doctor', 'patient'); 
            
        
    	return view('admin.user.addprescription', compact('prescription_list'));   
    }
}

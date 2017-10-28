<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\CancelAppointment;
use App\Http\Requests;
use Auth;
use App\Http\Controllers\Controller;

class CancelationListController extends Controller
{
 
  public function index(){
	 $viewCancel = CancelAppointment::where('cancel_by', Auth::user()->id)->with('users')->get();
	 
     return view('admin.user.cancelation_list', compact('viewCancel'));
  }
}

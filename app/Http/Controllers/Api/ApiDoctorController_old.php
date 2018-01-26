<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\AppointmentRequest;
use App\DoctorPrescription;
use App\CancelAppointment;
use App\Http\Controllers\Controller;

class ApiDoctorController extends Controller
{
    
    public function showDoctorAppointment($user_id){

    	$appointment_list = AppointmentRequest::where('assign_to', $user_id)->orderBy('created_at', 'DESC')->get()->load('users', 'checkcancelStatus');

    	foreach($appointment_list as $key=>$value){
    		$appointment_list[$key]['patient_name'] = $value['users']['name'];
    		$appointment_list[$key]['patient_email'] = $value['users']['email'];
    		$appointment_list[$key]['appointment_time'] = $value['appointment_time'];

    		unset($appointment_list[$key]['users']);
    	}

    	return response()->json([
    			'code' => 200,
    			'status' => 'Success',
    			'data'	=> $appointment_list
    		]);

    }
	 
    public function showDoctorAppointmentById($id){
    	
        $appointment_seen = AppointmentRequest::find($id);
        $appointment_seen->seen = 'Seen';
        $appointment_seen->save();


        $appointment_detail = AppointmentRequest::where('id', $id)->first()->load('users','prescription');

        $apt_detail = array();
        $apt_detail['patient_name'] = $appointment_detail['users']['name'];
        $apt_detail['notes'] = $appointment_detail['notes'];
        $apt_detail['patient_email'] = $appointment_detail['users']['email'];
        $apt_detail['appointment_time'] = $appointment_detail['appointment_time'];
        $apt_detail['msg_by_pharmist'] = $appointment_detail['prescription']['message_from_pharmist'];
        $apt_detail['prescription'] = $appointment_detail['prescription']['prescription'];
        $apt_detail['set_reminder'] = $appointment_detail['prescription']['set_reminder'];
        $apt_detail['remarks'] = $appointment_detail['prescription']['remarks'];

        return response()->json([
    			'code' => 200,
    			'status' => 'Success',
    			'data'	=> $apt_detail
    		]);

    }

    public function updateCreate(Request $request, $id=0)
    {

        $patient = User::find($request->to_patient);

        $auth = Auth::user();
        $latitude = $patient->lat;
        $longitude = $patient->lng;

        $nearBy = DB::select(
               "SELECT *,  ( 3959 * acos( cos( radians('$latitude') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( lat ) ) ) ) AS distance FROM users where user_type = 3 ORDER BY distance LIMIT 0 , 1
            ");

            $doctorPrescription = DoctorPrescription::firstOrNew([
                'appointment_id' => $request->appoint_id,
                'from_doctor' => $auth->id,
            ]);

            $doctorPrescription->for_patient = $request['to_patient'];
            $doctorPrescription->to_pharmist = $nearBy[0]->id;
            $doctorPrescription->lat = $nearBy[0]->lat;
            $doctorPrescription->lng = $nearBy[0]->lng;
            $doctorPrescription->distance = $nearBy[0]->distance;
            $doctorPrescription->appointment_id = $request['appoint_id'];
            $doctorPrescription->from_doctor = $auth->id;
            $doctorPrescription->prescription = $request['prescription'];
            $doctorPrescription->set_reminder = $request['set_reminder'];
            $doctorPrescription->remarks = $request['remarks'];
            $doctorPrescription->save();

            /*$appointmentReminder = AppointmentReminder::where('id',$order_id)->with('feastDate','user')->first();
            //event(new AppointmentReminder($doctorPrescription));*/

            if($doctorPrescription->exists){
                // add notification
                Notification::create(array(
                    'receiver_id' => $nearBy[0]->id,
                    'receiver_type' => 'pharmist',
                    'sender_id' => $auth->id,
                    'sender_type' => 'doctor',
                    'object' => 'send',
                    'verb' => 'request',
                    'message' => "Hi {{name}}, update the prescription for you",
                    'metadata' => json_encode(array(
                        'type' => 'prescription_send',
                        'user_id' => $auth->id,
                        'return_id' => $doctorPrescription->id,
                        'name' => $auth->name
                    )),
                ));

             $full_name = $nearBy[0]->name;
            $subject = "Prescription update request";

            $this->sendEmail('auth.emails.prescription_update', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $nearBy[0]->email, $this->_fromName);

            $patient = User::find($request['to_patient']);
            // If patient has default pharmacy, send mail to default pharmacy
            if($patient && $pharma = $patient->hasDefaultPharmacy()){
              $this->sendEmail('auth.emails.prescription_update', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $pharma->email, $this->_fromName);
            }

            }else{

                // add notification
                        Notification::create(array(
                            'receiver_id' => $nearBy[0]->id,
                            'receiver_type' => 'pharmist',
                            'sender_id' => $auth->id,
                            'sender_type' => 'doctor',
                            'object' => 'send',
                            'verb' => 'request',
                            'message' => "Hi {{name}}, prescription for you",
                            'metadata' => json_encode(array(
                                'type' => 'prescription_send',
                                'user_id' => $auth->id,
                                'return_id' => $doctorPrescription->id,
                                'name' => $auth->name
                            )),
                        ));

            $full_name = $nearBy[0]->name;
            $subject = "Prescription Request";

            $this->sendEmail('auth.emails.prescription_request', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $nearBy[0]->email, $this->_fromName);


            $full_name = $request['patient_name'];
            $subject = "Doctor has written the prescriptions";

            $this->sendEmail('auth.emails.doctor_prescription', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $request['patient_email'], $this->_fromName);

        }

        return response()->json([
        		'code' => 200,
        		'status' => 'Success',
        		'message'	=> 'Prescription send successfully to ' . $nearBy[0]->name
        	]);

    }

    public function cancel(Request $request, $user_id){
     	
    	$user_id = $request->user_id;

    	$appointmentRequest = AppointmentRequest::find($user_id);

        CancelAppointment::create([
            'appointment_id' => $request->appointment_id,
            'patient_id' => $appointmentRequest->user_id,
            'cancel_by' => $user_id
        ]);

        return response()->json([
        		'code' => 200,
        		'status' => 'Success',
        		'message'	=> 'Booking cancel successfully'
        	]);

    }

    public function appointmentReminder($user_id){
	
     	$appointmentReminder = DoctorPrescription::where('from_doctor', $user_id)->whereNotNull('set_reminder')->get();

     	if(!$appointmentReminder){
     		return response()->json([
        		'code' => 400,
        		'message'	=> 'Not Found',
        		'data' => $appointmentReminder
        	]);
     	}

     	return response()->json([
        		'code' => 200,
        		'status' => 'Success',
        		'message'	=> 'Booking cancel successfully',
        		'data' => $appointmentReminder
        	]);
 
    }

    public function updateFunction(&$array){
        foreach($array as $key=>$item){
        
          $array[$key]['id'] = $item['id'];
          $array[$key]['name'] = $item['users']['name'];
          $array[$key]['email'] = $item['users']['email'];

          unset($array[$key]['users']);
        }
    }

    public function cancelation_list($user_id){
    	$viewCancel = CancelAppointment::where('cancel_by', $user_id)->with('users')->get();

    	$this->updateFunction($viewCancel);

    	if(!$viewCancel){
    		return response()->json([
        		'code' => 400,
        		'message'	=> 'Not Found',
        		'data' => $viewCancel
        	]);
    	}
    	return response()->json([
        		'code' => 200,
        		'status' => 'Success',
        		'message'	=> 'Cancellation List',
        		'data' => $viewCancel
        	]);
    }

    
}

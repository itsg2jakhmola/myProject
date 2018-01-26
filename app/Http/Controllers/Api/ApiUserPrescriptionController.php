<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\DoctorPrescription;
use App\PharmistRequest;
use App\Notification;
use App\PharmaTracking;
use App\Http\Requests;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;
use Dingo\Api\Routing\Helpers;

class ApiUserPrescriptionController extends Controller
{   
  use EmailTrait;
  use Helpers;

    public function updateFunction(&$array){
        foreach($array as $key=>$item){
        
          $array[$key]['id'] = $item['id'];
          $array[$key]['doctor_name'] = $item['doctor']['name'];
          $array[$key]['appointment_id'] = $item['appointment_id'];
          $array[$key]['seen'] = $item['seen'];

          unset($array[$key]['pharmist'], $array[$key]['booking_request'], $array[$key]['doctor']);
        }
    }

    public function updateFunctionbyId(&$array){
        foreach($array as $key=>$item){
        
          $array[$key]['appointment_id'] = $item['appointment_id'];
          $array[$key]['doctor_name'] = $item['doctor']['name'];
          $array[$key]['doctor_address'] = $item['doctor']['address'];
          $array[$key]['email'] = $item['doctor']['email'];
          $array[$key]['phone'] = $item['doctor']['phone_number'];
          $array[$key]['reminder'] = $item['set_reminder'];
          $array[$key]['reminder_notes'] = $item['remarks'];
          $array[$key]['patient_name'] = $item['patient']['name'];
          $array[$key]['patient_address'] = $item['patient']['address'];
          $array[$key]['patient_email'] = $item['patient']['email'];
          $array[$key]['patient_phone'] = $item['patient']['phone_number'];
          $array[$key]['amount'] = $item['tracking']['amount'];
          $array[$key]['pick_date'] = $item['tracking']['packed_date'];
          $array[$key]['pick_time'] = $item['tracking']['packed_time'];

          unset($array[$key]['patient'], $array[$key]['doctor'], $array[$key]['pharmist'], $array[$key]['tracking'], $array[$key]['booking_request']);
        }
    }
    
    public function show($user_id, $user_type){

      if($user_type == 1){

            $prescription_list = DoctorPrescription::where('for_patient', $user_id)->orderBy('created_at', 'DESC')->get()->load('doctor', 'pharmist', 'booking_request'); 
            
            $this->updateFunction($prescription_list);

            return response()->json([
                      'Response' => 'Ok',
                      'code' => '200',
                      'data' => $prescription_list
                      ]);
        }

        if($user_type == 2){
            $prescription_list = DoctorPrescription::where('from_doctor', $user_id)->orderBy('created_at', 'DESC')->get()->load('doctor');    

            $this->updateFunction($prescription_list);

            return response()->json([
                      'Response' => 'Ok',
                      'code' => '200',
                      'data' => $prescription_list
                      ]);
        }

        if($user_type == 3){
            $prescription_list = DoctorPrescription::where('to_pharmist', $user_id)->orderBy('created_at', 'DESC')->get()->load('doctor');    
            //return $this->response->collection($prescription_list, new ProjectTransformer())->setStatusCode(200); 

            $this->updateFunction($prescription_list);

            return response()->json([
                      'Response' => 'Ok',
                      'code' => '200',
                      'data' => $prescription_list
                      ]);
        }

        
    }

    public function showById($id)
    {
        
        $prescription_seen = DoctorPrescription::find($id);
        $prescription_seen->seen = 'Seen';
        $prescription_seen->save();

        $prescription_detail = DoctorPrescription::where('id', $id)->first()->load('doctor', 'patient', 'pharmist', 'tracking', 'booking_request');
        
        //$this->updateFunctionbyId($prescription_detail);

        $array = array();

         $array['appointment_id'] = $prescription_detail['appointment_id'];
          $array['doctor_id'] = $prescription_detail['doctor']['id'];
          $array['doctor_name'] = $prescription_detail['doctor']['name'];
          $array['doctor_address'] = $prescription_detail['doctor']['address'];
          $array['email'] = $prescription_detail['doctor']['email'];
          $array['phone'] = $prescription_detail['doctor']['phone_number'];
          $array['reminder'] = $prescription_detail['set_reminder'];
          $array['reminder_notes'] = $prescription_detail['remarks'];
          $array['patient_id'] = $prescription_detail['patient']['id'];
          $array['patient_name'] = $prescription_detail['patient']['name'];
          $array['patient_address'] = $prescription_detail['patient']['address'];
          $array['patient_email'] = $prescription_detail['patient']['email'];
          $array['patient_phone'] = $prescription_detail['patient']['phone_number'];
          $array['amount'] = $prescription_detail['tracking']['amount'];
          $array['pick_date'] = $prescription_detail['tracking']['packed_date'];
          $array['pick_time'] = $prescription_detail['tracking']['pack_time'];
          $array['pharmist'] = $prescription_detail['pharmist']['name'];

        return response()->json([
                      'Response' => 'Ok',
                      'code' => '200',
                      'data' => $array
                      ]);
    }

     public function update(Request $request, $user_id, $id)
      {

          $patient = User::find($request->patient_id);

          $auth = User::find($user_id);
          //$pharmaTracking = PharmaTracking::create($request->all());
          $pharmaTracking = PharmaTracking::firstOrNew([
                 'appointment_id' => $request->appointment_id 
          ]);   

          $pharmaTracking->appointment_id =  $request->appointment_id;
          $pharmaTracking->doctor_id =  $request->doctor_id;
          $pharmaTracking->patient_id =  $request->patient_id;
          $pharmaTracking->packed_date =  $request->packed_date;
          $pharmaTracking->pack_time = $request->pack_time;
          $pharmaTracking->pharma_name = $request->pharma_name;
          $pharmaTracking->amount = $request->amount;
          $pharmaTracking->save();


          // add notification
          Notification::create(array(
              'receiver_id' => $patient->id,
              'receiver_type' => 'patient',
              'sender_id' => $auth->id,
              'sender_type' => 'pharmist',
              'object' => 'send',
              'verb' => 'tracking',
              'message' => "Hi {{name}} has sent your prescription tracking",
              'metadata' => json_encode(array(
                  'type' => 'send_tracking',
                  'user_id' => $auth->id,
                  'name' => $auth->name
              )),
          ));

          $full_name = $patient->name;
          $subject = "Your Prescription is ready ";

          $this->sendEmail('auth.emails.prescription_done', ["full_name" => $full_name, "pharmist" => $auth], $subject, $patient->email, $this->_fromName);

          return response()->json([
                      'Response' => 'Ok',
                      'code' => '200',
                      'data' => $pharmaTracking
                      ]);
      }
}  
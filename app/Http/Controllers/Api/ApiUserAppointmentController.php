<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;
use JWTAuth;
use Auth;
use App\User;
use App\Appointment;
use App\Notification;
use App\AppointmentRequest;
use App\DefaultUser;
use JWTAuthException;

class ApiUserAppointmentController extends Controller
{
   use EmailTrait;

   public function updateArray(&$appointment_list){
                foreach($appointment_list  as $key => $item){
                    $appointment_list[$key]['seen'] = $item['appointment_request']['seen'];
                    $appointment_list[$key]['assigned_name'] = $item['appointment_request']['assigned_name'];
                    unset($appointment_list[$key]['appointment_request']);
                }
            }

   public function getAppointment(Request $request, $user_id)
    {
        
        $appointment_list = Appointment::with('appointment_request')
                            ->where('user_id', $user_id)->orderBy('created_at', 'DESC')->get()->toArray();
         
      
            $this->updateArray($appointment_list);
           // print_r($appointment_list);

        return response()->json(compact('appointment_list'));
    }

   public function apiAddAppointment(Request $request, $user_id) {
        
        //$user = JWTAuth::toUser($request->token);
        $user = User::find($user_id);
        
        $latitude = $user->lat;
        $longitude = $user->lng;
        
        $nearby = DefaultUser::where('user_id', $user->id)
                            ->first();
        if($nearby){
            $nearby->load('assignedUser');
        }else{
            return response()->json([
                    'success' => false,
                    'code'  => 404,
                    'message' => 'Doctor is not assigned',
                ], 404);
        }
                            
            
        $request['request_to'] = $nearby['assignedUser']->id;
        $request['user_id'] = $user->id;

        $fixappointment = Appointment::create($request->all());
        if($fixappointment){
            $appointment = new AppointmentRequest;
            $appointment->user_id = $user->id;
            $appointment->appointment_id = $fixappointment->id;
            $appointment->assign_to = $nearby['assignedUser']->id;
            $appointment->assigned_name = $nearby['assignedUser']->name;
            $appointment->lat = $nearby['assignedUser']->lat;
            $appointment->lng = $nearby['assignedUser']->lng;
            $appointment->distance = $nearby['assignedUser']->distance;
            $appointment->appointment_time = $fixappointment->appointment_time;
            $appointment->speciality = $nearby['assignedUser']->doctor_practice;
            $appointment->notes = $fixappointment->notes;
            $appointment->save();
        }

        // add notification
        Notification::create(array(
            'receiver_id' => $nearby['assignedUser']->id,
            'receiver_type' => 'doctor',
            'sender_id' => $user->id,
            'sender_type' => 'patient',
            'object' => 'appointment',
            'verb' => 'request',
            'message' => "Hi {{name}}, your appointment request",
            'metadata' => json_encode(array(
                'type' => 'appointment_request',
                'user_id' => $user->id,
                'name' => $user->name
            )),
        ));

        $full_name = $nearby['assignedUser']->name;
        $subject = "Appointment Request";

        $this->sendEmail('auth.emails.appointment_request', ["full_name" => $full_name, "patient" => $user->name], $subject, $nearby['assignedUser']->email, $this->_fromName);

        $bookingRequest = 'Your booking request has been sent to the ' . $nearby['assignedUser']->name;

        return response()->json(compact('bookingRequest'));

   }

   public function showAppointment($id)
   {
    
     $appointment_detail = Appointment::with('appointment_request', 'prescriptions', 'users')->where('id', $id)->first()->toArray();
    
     $array = array();
     $array['doctor_specility'] = $appointment_detail['doctor_speciality'];
     $array['notes'] = $appointment_detail['notes'];
     $array['appointment_time'] = $appointment_detail['appointment_time'];
     $array['status'] = $appointment_detail['appointment_request']['seen'];
     $array['doctor_name'] = $appointment_detail['users']['name'];
     $array['doctor_email'] = $appointment_detail['users']['email'];
     $array['doctor_phone'] = $appointment_detail['users']['phone_number'];
     

      return response()->json(compact('array'))->setStatusCode(200);
   }

   public function editAppointment($id){

         $appointmentRequest = Appointment::find($id);
          $users = user::where('user_type', '2')->get();
        
         $array = array();
         $array['doctor_specility'] = $appointmentRequest['doctor_speciality'];
         $array['description'] = $appointmentRequest['notes'];
         $array['appointment_time'] = $appointmentRequest['appointment_time'];
         

           return response()->json(compact('array'));
   }

   public function updateAppointment(Request $request, $id)
    {

         $rules = [
            'notes' => 'required'
         ];

         $validator = \Validator::make($request->all(), $rules);

         //If fail validation show the error

         if ($validator->fails()) {    
            return response()->json($validator->messages(), 401);
        }

        $appointment = Appointment::find($id);
        $appointment->notes = $request['notes'];
        $appointment->appointment_time = $request['appointment_time'];
        $appointment->save();

         return response()->json(['Response' => 'Well done!! Appointment detail updated successfully']);
    }

    public function removeAppointment(Request $request, $id){

         $appointment = Appointment::findOrFail($id);
         $appointment->delete();

         return response()->json(['Response' => 'Appointment Deleted Successfully']);   
    }   
}

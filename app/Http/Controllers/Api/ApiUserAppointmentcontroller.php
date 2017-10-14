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

class ApiUserAppointmentcontroller extends Controller
{
   use EmailTrait;
   public function addAppointment(Request $request) {
   		
   		$user = JWTAuth::toUser($request->token);
   		
        $latitude = $user->lat;
        $longitude = $user->lng;
        
        $nearby = DefaultUser::where('user_id', $user->id)
                            ->first()->load('assignedUser');
        
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
}

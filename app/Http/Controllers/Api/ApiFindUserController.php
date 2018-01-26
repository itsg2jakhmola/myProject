<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Auth;
use App\User;
use App\DefaultUser;
use App\DoctorPrescription;
use JWTAuthException;

class ApiFindUserController extends Controller
{   
    
    public function index($user_id)
    {
        $auth = User::find($user_id);

        $userInfo = DefaultUser::where('user_id', $auth->id)->first();
        
        if($userInfo){
            $doctorInfo = $auth->find($userInfo->assign_to_doctor);
            $pharmistInfo = $auth->find($userInfo->assign_to_pharmist);    
        }else{
            $doctorInfo = null;
            $pharmistInfo = null;
        }
        
        return response()->json(compact('userInfo', 'doctorInfo', 'pharmistInfo'));
    }


    public function showUser(Request $request, $user_type) {

         $this->validate($request, [
                'email'     => 'required_without_all:email,phone,doctor_practice,address',
                'phone'  => 'required_without_all:email,phone,doctor_practice,address',
                'doctor_practice'  => 'required_without_all:email,phone,doctor_practice,address',
                'address'  => 'required_without_all:email,phone,doctor_practice,address',
            ]);

        if(!empty($request->all() ) ){
            $querry = User::orderBy('id');

            if(!empty($request->doctor_practice)){
                $querry->where('doctor_practice',$request->doctor_practice)
                        ->where('user_type', $user_type);
            }
            if(!empty($request->phone)){
                $querry->where('phone_number',$request->phone)
                        ->where('user_type', $user_type);
            }
            if(!empty($request->email)){
                $querry->where('email',$request->email)
                    ->where('user_type', $user_type);
            }
            if(!empty($request->address)){
                $querry->where('address',$request->address)
                    ->where('user_type', $user_type);
            }

            $userDetail  = $querry->first();   
        }

        if(!$userDetail){
            return response()->json([
                'Response' => 'Not found please try again!',
                'code' => 404
              ]);
        }
        
        return response()->json(compact('userDetail'));
    }

    public function updateCreate(Request $request, $user_id, $id=null)
    {
        $auth = User::find($user_id);

        if($request->user_type == 1){
                 $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone_number)
                                ->first();
        }
        if($request->user_type == 2){
                 $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone_number)
                                ->first();

        }if($request->user_type == 3){
             $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone_number)
                                ->first();
        }

            $checkUser = DefaultUser::firstOrNew([
                'user_id' => $auth->id
            ]);
            
         $checkUser->user_id = $auth->id;
         
         if($user->user_type == 1){
             $registerDefaultUser = 'Patient';
             $checkUser->assign_to_patient = $user->id;
            }
         else if($user->user_type == 2){
            $registerDefaultUser = 'Doctor';
             $checkUser->assign_to_doctor = $user->id;
            }
            
            else if($user->user_type == 3){
              $registerDefaultUser = 'Pharmist';
                $checkUser->assign_to_pharmist = $user->id;   
         
            }else{
              return response()->json([
                'Response' => 'Oh Snap! Something went wrong try again later',
                'code' => 404
              ]);
            }

         $checkUser->save();

         return response()->json([
                'Response' => 'Your default ' . $registerDefaultUser . ' ' . $user->name . ' is saved',
                'code' => 200
              ]);

    }
}  
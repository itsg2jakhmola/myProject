<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use Auth;
use App\User;
use JWTAuthException;

class ApiUserController extends Controller
{   
    private $user;

    public function __construct(User $user){
        $this->user = $user;
    }
   
    public function register(Request $request) {

    	$rules = [
		    'first_name' => 'required|min:3',
		    'email' => 'required|email|max:255|unique:users',
		    'password' => 'required|min:6|confirmed',
		    'password_confirmation' => 'required',
		    'address' => 'required',
		    'phone_number' => 'required',
		];

		if($request->user_type == 1 ){
		    $rules['dob'] =  'required';
		}else if($request->user_type == 2 ){
		    $rules['doctor_practice'] =  'required';
		}

		// then, if it fails, return the error messages in JSON format

		$validator = \Validator::make($request->all(), $rules);
		if ($validator->fails()) {    
		    return response()->json($validator->messages(), 401);
		}

		
        $user = $this->user->create([
          'first_name' => $request->get('first_name'),
          'middle_name' => $request->get('middle_name'),
          'last_name' => $request->get('last_name'),
          'name' => $request->get('name'),
          'user_type' => $request->get('user_type'),          
          'email' => $request->get('email'),
          'password' => bcrypt($request->get('password')),
          'dob' => $request->get('dob'),
          'medical_number' => $request->get('medical_number'),
          'address' => $request->get('address'),
          'phone_number' => $request->get('phone_number'),
          'doctor_practice' => $request->get('doctor_practice'),
          'fax_number' => $request->get('fax_number'),
          'insurance_company' => $request->get('insurance_company'),
          'insurance_number' => $request->get('insurance_number'),
          'practice_licence' => $request->get('practice_licence'),
          'lat' => $request->get('lat'),
          'lng' => $request->get('lng'),
        ]);

        return response()->json(['status'=>true,'message'=>'User created successfully','data'=>$user]);
    }
    
    public function login(Request $request){

        $credentials = $request->only('email', 'user_type', 'password');
        $token = null;
        try {
           if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['Invalid Credentials, Please make sure you have correct user type'], 422);
           }
        } catch (JWTAuthException $e) {
            return response()->json(['failed_to_create_token'], 500);
        }
        $currentUser = JWTAuth::toUser($token);
        return response()->json(compact('token', 'currentUser'));
    }

    public function getAuthUser(Request $request){
        $user = JWTAuth::toUser($request->token);
        return response()->json(['result' => $user]);
    }
}  
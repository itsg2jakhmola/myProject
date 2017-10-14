<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\User;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UserSuggestion extends Controller
{
    public function findUser(Request $request)
    {
    	
    	$findUserType = (string)$_GET['user_type'];

		$searchTerm = $_GET['term'];
	    if(Auth::user()->user_type == 1){
	    	
	    	$data = User::where('email', 'like', '%' . $searchTerm . '%')
	    			->where('user_type', $findUserType)->first();	
	    }else{
	    	$data = User::where('email', 'like', '%' . $searchTerm . '%')
	    			->where('user_type', $findUserType)->first();
	    }
	    
	    if(!$data){
	    	return \Response::json([
		    	'success' => false,
		    	'message' => "Data Not Found",
		    	'response' => $data
	    	], 400);
	    }
		    
	    return \Response::json([
	    	'success' => true,
	    	'message' => $data->email,
	    	'response' => $data
	    ], 200);
     }

   public function findUserByPhone(Request $request)
    {

		$findUserType = (string)$_GET['user_type'];

		$searchTerm = $_GET['term'];
	    
	    if(Auth::user()->user_type == 1){
	    	$result = User::where('phone_number', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }else{
		 	$result = User::where('phone_number', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }

		 if(!$result){
	    	return \Response::json([
		    	'success' => false,
		    	'message' => "Data Not Found",
		    	'response' => $result
	    	], 400);
	    }

	    return \Response::json([
	    	'success' => true,
	    	'data' => (string) $result->phone_number,
	    	'response' => $result
	    ], 200);
     }

    public function findUserByName(Request $request)
    {

		$findUserType = (string)$_GET['user_type'];

		$searchTerm = $_GET['term'];
	    
	    if(Auth::user()->user_type == 1){
	    	$result = User::where('doctor_practice', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }else{
		 	$result = User::where('doctor_practice', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }

		 if(!$result){
	    	return \Response::json([
		    	'success' => false,
		    	'message' => "Data Not Found",
		    	'response' => $result
	    	], 400);
	    }

	    return \Response::json([
	    	'success' => true,
	    	'data' =>  $result->doctor_practice,
	    	'response' => $result
	    ], 200);
     }

     public function findUserByAddress(Request $request)
     {
     	$findUserType = (string)$_GET['user_type'];

		$searchTerm = $_GET['term'];
	    
	    if(Auth::user()->user_type == 1){
	    	$result = User::where('address', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }else{
		 	$result = User::where('address', 'like', '%' . $searchTerm . '%')->where('user_type', $findUserType)->first();
		 }

		 if(!$result){
	    	return \Response::json([
		    	'success' => false,
		    	'message' => "Data Not Found",
		    	'response' => $result
	    	], 400);
	    }

	    return \Response::json([
	    	'success' => true,
	    	'data' =>  $result->address,
	    	'response' => $result
	    ], 200);
     }

     
}

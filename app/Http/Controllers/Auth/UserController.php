<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Http\Requests;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class UserController extends Controller
{

	use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /*protected function credentials(Request $request)
	{

	    $credentials = $request->only($this->username(), 'password');
	    $credentials['user_type'] = '3';

	    return $credentials;

	}*/

	/**
* [login description]
* @param  Request $request [description]
* @return [type]           [description]
*/
	protected function register(array $data)
    {

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'user_type' => $data['user_type'],
            'dob' => ($data['dob']) ? $data['dob'] : '',
            'medical_number' => ($data['medical_number']) ? $data['medical_number'] : '',
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'insurance_company' => ($data['insurance_company']) ? $data['insurance_company'] : '' ,
            'insurance_number' => ($data['insurance_number']) ? $data['insurance_number'] : '' ,
            'password' => bcrypt($data['password']),
        ]);
    }
}

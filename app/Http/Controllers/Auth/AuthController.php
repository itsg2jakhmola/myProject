<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use App\Http\Controllers\Traits\EmailTrait;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;
    use EmailTrait;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin/welcome';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
           'first_name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
            //'dob' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            //'doctor_practice' => 'required',

        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        
        $encryptPwd = $data['password'];

        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'middle_name' => $data['middle_name'],
            'name' => $data['first_name'] . " " . $data['last_name'],
            'email' => $data['email'],
            'user_type' => $data['user_type'],
            'dob' => ($data['dob']) ? $data['dob'] : '',
            'medical_number' => ($data['medical_number']) ? $data['medical_number'] : '',
            'address' => $data['address'],
            'phone_number' => $data['phone_number'],
            'doctor_practice' => ($data['doctor_practice']) ? $data['doctor_practice'] : 'NULL',
            'fax_number' => ($data['fax_number']) ? $data['fax_number'] : '',
            'lat' => $data['lat'],
            'lng' => $data['lng'],
            'insurance_company' => ($data['insurance_company']) ? $data['insurance_company'] : '' ,
            'insurance_number' => ($data['insurance_number']) ? $data['insurance_number'] : '' ,
            'practice_licence' => ($data['doctor_practice']) ? $data['doctor_practice'] : '' ,
            'password' => bcrypt($encryptPwd),
            
        ]);

        // add event here
        //event(new UserWasRegistered)

        $subject = 'MedCrip Application login credentials';

        $this->sendEmail('auth.emails.application_accepted', ["full_name" => $data['first_name'], "username" => $data['email'], "password" => $encryptPwd], $subject, $data['email'], $this->_fromName);

        return $user;
        
    }
}

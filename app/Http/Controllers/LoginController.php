<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Validator;
use App\Http\Requests;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class LoginController extends Controller
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
	public function login( Request $request )
	{
		//print_r($request->all());die;
	    $this->validateLogin( $request );
	    $throttles = $this->isUsingThrottlesLoginsTrait();

	    if ( $throttles && $lockedOut = $this->hasTooManyLoginAttempts( $request ) ) {
	        $this->fireLockoutEvent( $request );
	        return $this->sendLockoutResponse( $request );
	    }
	    $credentials = $this->getCredentials( $request );
	    if ( Auth::guard( $request['user_type'] )->attempt( [ 'user_type' => $request['user_type'] ] + $credentials, $request->has( 'remember' ) ) ) {
	        return $this->handleUserWasAuthenticated( $request, $throttles, $guard );
	    }

	    // check to see if they can login without the active flag
	    if( Auth::guard( $guard )->attempt( $credentials ) ) {
	        // log them back out and send them back
	        Auth::guard( $guard )->logout();
	        return redirect()->back()
	            ->withInput( $request->only( $this->loginUsername(), 'remember' ) )
	            ->withErrors([
	                'active' => 'Your account is currently not active',
	            ]);
	    }
	    if ( $throttles && ! $lockedOut ) {
	        $this->incrementLoginAttempts( $request );
	    }
	    return $this->sendFailedLoginResponse( $request );
	}
}

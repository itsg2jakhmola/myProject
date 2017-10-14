<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
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
	    $credentials['user_type'] = $request['user_type']; 
	    //print_r($credentials);die;
	    /*if ( Auth::guard( $request['user_type'] )->attempt( [ 'user_type' => $request['user_type'] ] + $credentials, $request->has( 'remember' ) ) ) {
	        return $this->handleUserWasAuthenticated( $request, $throttles, $guard );
	    }*/


       	if (Auth::attempt($credentials, $request->has('remember'))) {
            return $this->handleUserWasAuthenticated($request, $throttles);
        }

	    // check to see if they can login without the active flag
	    if( Auth::attempt( $credentials ) ) {
	        // log them back out and send them back
	        Auth::logout();
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

	/**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->loginUsername() => 'required', 'password' => 'required',
        ]);
    }

    /**
     * Get the failed login response instance.
     *
     * @param \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        return redirect()->back()
            ->withInput($request->only($this->loginUsername(), 'remember'))
            ->withErrors([
                $this->loginUsername() => $this->getFailedLoginMessage(),
            ]);
    }

    /**
     * Get the failed login message.
     *
     * @return string
     */
    protected function getFailedLoginMessage()
    {
        return Lang::has('auth.failed')
                ? Lang::get('auth.failed')
                : 'These credentials do not match our records.';
    }
}

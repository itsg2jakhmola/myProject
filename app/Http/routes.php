<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/* Dingo API */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api){
    $api->get('testing', function(){
        return "Hello";
    });
});

$api->version('v1', function($api){
    $api->get('testmethod', 'App\Http\Controllers\Api\ApiUserController@index');
    $api->post('auth/login', 'App\Http\Controllers\Api\ApiUserController@login');
    $api->post('auth/register', 'App\Http\Controllers\Api\ApiUserController@register');

});

$api->version('v1', ['middleware' => 'api.auth'], function($api){
    
    $api->get('auth/user', 'App\Http\Controllers\Api\ApiUserController@getAuthUser');
    
    $api->get('auth/getappointment', 'App\Http\Controllers\Api\ApiUserAppointmentController@getAppointment');
    
    $api->get('auth/showappointment/{id}', 'App\Http\Controllers\Api\ApiUserAppointmentController@showAppointment');
    
    $api->post('add/appointment', 'App\Http\Controllers\Api\ApiUserAppointmentController@addAppointment');

    $api->get('edit/appointment/{id}', 'App\Http\Controllers\Api\ApiUserAppointmentController@editAppointment');
    
    $api->patch('update/appointment/{id}', 'App\Http\Controllers\Api\ApiUserAppointmentController@updateAppointment');

    $api->delete('remove/appointment/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@removeAppointment');

    $api->post('add/medicalhistory', 'App\Http\Controllers\Api\ApiMedicalhistoryController@createMedicalHistory');
   
    $api->get('show/medical/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@showMedicalHistory');

    $api->get('edit/editmedical/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@editMedicalHistory');
    
    $api->delete('remove/medical/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@removeMedicalHistory');

    $api->patch('update/medicalhistory/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@updateMedicalHistory');

});

/* End Dingo API */


Route::get('/', function () {
    return view('homepage');
});

/*Route::get('test', function(){
    $mail = Mail::send('auth.emails.test', ['user' => "Sachin"], function ($message) {
            $message->from('notification@feastby.com', 'Feastby');
            $message->to("sachintendulkar3@yopmail.com", "sachin")->subject('MedCrip | Request Email test');
        });
});*/

// Display all SQL executed in Eloquent
/*Event::listen('illuminate.query', function($query)
{
    var_dump($query);
});*/

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function()
{
    //Route::get('/welcome', 'Admin\DashboardController@index');
    Route::get('/welcome', 'Admin\UserController@index');
    //Route::get('/user', 'Admin\UserController@index');
    //Route::get('/apppoinment', 'Admin\AppoinmentController@index');
    //Route::get('/prescription', 'Admin\PrescriptionController@index');
    Route::resource('medical_history', 'Admin\MedicalHistoryController');
    Route::resource('find_user', 'Admin\FindUserController');
     Route::get('show/user/info/{email?}/{phone?}', ['uses' =>'Admin\FindUserController@showUser', 'as' => 'admin.user.view_detail']);
    Route::post('send/suggestedUser/{id?}', ['uses' =>'Admin\FindUserController@updateCreate', 'as' => 'admin.find_user.updateCreate']);

    Route::resource('appointment_setting', 'Admin\MyAppointmentController');
    Route::resource('docappoint_setting', 'Admin\DoctorAppointmentController');
    Route::resource('pharmist_setting', 'Admin\PharmacyController');
    Route::post('update/format', ['uses' =>'Admin\DoctorAppointmentController@format', 'as' => 'admin.docappoint_setting.format']);

    Route::post('update/format/{id?}', ['uses' =>'Admin\DoctorAppointmentController@updateCreate', 'as' => 'admin.docappoint_setting.updateCreate']);

    Route::get('patient/medical_history', ['uses' => 'Admin\PatientMedicalHistory@show', 'as' => 'admin.patient.history']);
    Route::get('/review', ['uses' => 'Admin\ReviewController@index', 'as' => 'admin.review.index']);
    Route::get('/review/{id}', ['uses' => 'Admin\ReviewController@show', 'as' => 'admin.review.show']);
    Route::post('/review/send/{id}', ['uses' => 'Admin\ReviewController@review', 'as' => 'admin.review.review']);
    Route::get('/cancelation_list', 'Admin\CancelationListController@index');
    Route::get('/add_prscriptions', 'Admin\AddPrescriptionController@index');
    Route::get('/appoinment_reminder', 'Admin\ApppoinmentReminderController@index');
    
    Route::post('user/update/{user_id}', ['uses' =>'Admin\UserController@update', 'as' => 'admin.user.update']);
});


Route::group(['prefix' => '/api', 'namespace' => 'Api', 'middleware' => 'auth'], function () {
  // Notifications
  Route::get('user/suggestion/email', ['uses' => 'UserSuggestion@findUser', 'as'=>'api.user.suggestion']);
  Route::get('user/suggestion/phone', ['uses' => 'UserSuggestion@findUserByPhone', 'as'=>'api.user.suggestionphone']);
  Route::get('user/suggestion/practicename', ['uses' => 'UserSuggestion@findUserByName', 'as'=>'api.user.suggestionpracticename']);
  Route::get('user/suggestion/address', ['uses' => 'UserSuggestion@findUserByAddress', 'as'=>'api.user.suggestionaddress']);
  Route::get('user/notify', 'NotificationController@index');
  Route::get('user/notifications', 'NotificationController@getMessages');
  Route::post('user/shownotifications', 'NotificationController@showMessages');
  Route::post('user/readnotification', 'NotificationController@readMessage');

});
Route::group(['middlewareGroups' => 'web', 'namespace' => 'Auth'], function () {
    Route::get('/login', 'AuthController@showLoginForm');
    Route::get('/logout', 'AuthController@logout');
    Route::post('/password/email', 'PasswordController@sendResetLinkEmail');
    Route::post('/password/reset', 'PasswordController@reset');
    Route::get('/password/reset/{token?}', 'PasswordController@showResetForm');
    Route::get('/register', 'AuthController@showRegistrationForm');
    Route::post('/register/patient', 'AuthController@register');
    Route::post('/register/doctor', 'AuthController@register');
    Route::post('/register/pharmacy', 'AuthController@register');
    Route::post('/login/', 'LoginController@login');

    /*Route::get('/welcome', function () {
        return view('welcome');
    });*/

});

//Route::auth();

Route::get('/home', 'HomeController@index');
Route::get('/admins', function(){
        return view('admin.index');
    });
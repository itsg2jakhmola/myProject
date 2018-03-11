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

    $api->get('image/intervention', function(){


    });
});

$api->version('v1', function($api){
    $api->get('testmethod', 'App\Http\Controllers\Api\ApiUserController@index');
    $api->get('interven', 'App\Http\Controllers\Api\ApiUserController@showInter');
    $api->post('auth/login', 'App\Http\Controllers\Api\ApiUserController@login');
    $api->post('auth/register', 'App\Http\Controllers\Api\ApiUserController@register');

});

Route::group(['prefix' => 'api/v1'], function()
{

   Route::get('auth/user', 'Api\ApiUserController@getAuthUser');
    Route::get('auth/currentuser/{user_id}', 'Api\ApiUserController@getCurrentUser');
    
    Route::get('get/all/appointment/list/user_id/{user_id}', 'Api\ApiUserAppointmentController@getAppointment');
    
    Route::get('auth/showappointment/{id}', 'Api\ApiUserAppointmentController@showAppointment');
    
    Route::post('add/appointment/{id}', 'Api\ApiUserAppointmentController@apiAddAppointment');

    Route::get('edit/appointment/{id}', 'Api\ApiUserAppointmentController@editAppointment');
    
    Route::post('update/appointment/{id}', 'Api\ApiUserAppointmentController@updateAppointment');

    Route::post('remove/appointment/{id}', 'Api\ApiUserAppointmentController@removeAppointment');

    Route::post('add/medicalhistory', 'Api\ApiMedicalHistoryController@createMedicalHistory');
   
   Route::get('show/all/medicalhistory/user_id/{user_id}', 'Api\ApiMedicalHistoryController@showAllMedicalHistory');

    Route::get('show/medical/{id}', 'Api\ApiMedicalHistoryController@showMedicalHistory');

    Route::get('edit/editmedical/{id}', 'Api\ApiMedicalHistoryController@editMedicalHistory');
    
    Route::post('remove/medical/{id}', 'Api\ApiMedicalHistoryController@removeMedicalHistory');

    Route::post('update/medicalhistory/{id}', 'Api\ApiMedicalHistoryController@updateMedicalHistory');

    Route::get('show/prescription/{user_id}/type/{user_type}', 'Api\ApiUserPrescriptionController@show');

    Route::get('show/prescription/detail/{id}', 'Api\ApiUserPrescriptionController@showById');

    Route::post('update/prescription/detail/user_id/{user_id}/id/{id}', 'Api\ApiUserPrescriptionController@update');

    Route::post('user/update/{user_id}', 'Api\ApiUserController@update');

    Route::get('find/user/{user_id}', 'Api\ApiFindUserController@index');

    Route::post('find/user/by/param/{user_type}', 'Api\ApiFindUserController@showUser');

    Route::post('set/defaultUser/{user_id}/{id?}', 'Api\ApiFindUserController@updateCreate');

    Route::get('show/doctor/appointment/user_id/{user_id}', 'Api\ApiDoctorController@showDoctorAppointment');

    Route::get('show/doctor/appointment_reminder/user_id/{user_id}', 'Api\ApiDoctorController@appointmentReminder');

    Route::get('show/doctor/appointment/detail/id/{id}', 'Api\ApiDoctorController@showDoctorAppointmentById');

    Route::post('doctor/update/user_id/{user_id}/appointment/{appointment_id}/{id?}', 'Api\ApiDoctorController@updateCreate');

    Route::post('doctor/appointment/cancel/appointment_id/{appointment_id}/user_id/{id}', 'Api\ApiDoctorController@cancel');

    Route::get('doctor/appointment/cancelation_list/user_id/{user_id}', 'Api\ApiDoctorController@cancelation_list');

    Route::post('password/email', 'Api\ForgotPasswordController@sendResetLinkEmail');
    
    Route::post('password/reset', 'Api\ResetPasswordController@reset');

});

/*$api->version('v1', ['middleware' => 'api.auth'], function($api){
    
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

    $api->post('update/medicalhistory/{id}', 'App\Http\Controllers\Api\ApiMedicalhistoryController@updateMedicalHistory');

});*/

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
    Route::resource('alergic_history', 'Admin\AlergicHistoryController');
    Route::resource('find_user', 'Admin\FindUserController');
     Route::get('show/user/info/{email?}/{phone?}', ['uses' =>'Admin\FindUserController@showUser', 'as' => 'admin.user.view_detail']);
    Route::post('send/suggestedUser/{id?}', ['uses' =>'Admin\FindUserController@updateCreate', 'as' => 'admin.find_user.updateCreate']);

    Route::resource('appointment_setting', 'Admin\MyAppointmentController');
    Route::resource('lab_work', 'Admin\MyLabWorkController');
    Route::resource('docappoint_setting', 'Admin\DoctorAppointmentController');
    
    Route::post('docappoint_setting/cancel/{id}', ['as' => 'admin.docappoint_setting.cancel', 'uses'=> 'Admin\DoctorAppointmentController@cancel']);

    Route::resource('pharmist_setting', 'Admin\PharmacyController');
    Route::post('update/format', ['uses' =>'Admin\DoctorAppointmentController@format', 'as' => 'admin.docappoint_setting.format']);

    Route::post('update/format/{id?}', ['uses' =>'Admin\DoctorAppointmentController@updateCreate', 'as' => 'admin.docappoint_setting.updateCreate']);

    Route::get('patient/medical_history', ['uses' => 'Admin\PatientMedicalHistory@show', 'as' => 'admin.patient.history']);

    Route::get('patient/alergic_history', ['uses' => 'Admin\PatientMedicalHistory@showAlergic', 'as' => 'admin.patient.alergy_history']);

    Route::get('/review', ['uses' => 'Admin\ReviewController@index', 'as' => 'admin.review.index']);
    Route::get('/review/{id}', ['uses' => 'Admin\ReviewController@show', 'as' => 'admin.review.show']);
    Route::post('/review/send/{id}', ['uses' => 'Admin\ReviewController@review', 'as' => 'admin.review.review']);
    Route::get('/cancelation_list', 'Admin\CancelationListController@index');
    Route::get('/process', 'Admin\AddPrescriptionController@index');
    Route::post('order/process/{id}', ['uses' =>'Admin\PharmacyController@changeStatus', 'as' => 'admin.user.changeStatus']);
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

Route::get('resizeImage', 'ImageController@resizeImage');

Route::post('resizeImagePost',['as'=>'resizeImagePost','uses'=>'ImageController@resizeImagePost']);

Route::get('console/command', function(){

    $appointmentReminder = \DB::table('prescriptions')
                        ->where('from_doctor', '35')
                        ->whereNotNull('set_reminder')
                        ->get();

        dd($appointmentReminder);
});
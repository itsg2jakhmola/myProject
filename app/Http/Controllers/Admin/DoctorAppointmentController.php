<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Notification;
use App\AppointmentRequest;
use App\DoctorPrescription;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;

class DoctorAppointmentController extends Controller
{
    use EmailTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();

        $appointment_list = AppointmentRequest::where('assign_to', $auth->id)->orderBy('created_at', 'DESC')->get()->load('users');


        return view('admin.user.doctor_appointment.index', compact('appointment_list'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request){

    }

    public function updateCreate(Request $request, $id=0)
    {

        $patient = User::find($request->to_patient);

        $auth = Auth::user();
        $latitude = $patient->lat;
        $longitude = $patient->lng;

        $nearBy = DB::select(
               "SELECT *,  ( 3959 * acos( cos( radians('$latitude') ) * cos( radians( lat ) ) * cos( radians( lng ) - radians('$longitude') ) + sin( radians('$latitude') ) * sin( radians( lat ) ) ) ) AS distance FROM users where user_type = 3 ORDER BY distance LIMIT 0 , 1
            ");

            $doctorPrescription = DoctorPrescription::firstOrNew([
                'appointment_id' => $request->appoint_id,
                'from_doctor' => $auth->id,
            ]);

            $doctorPrescription->for_patient = $request['to_patient'];
            $doctorPrescription->to_pharmist = $nearBy[0]->id;
            $doctorPrescription->lat = $nearBy[0]->lat;
            $doctorPrescription->lng = $nearBy[0]->lng;
            $doctorPrescription->distance = $nearBy[0]->distance;
            $doctorPrescription->appointment_id = $request['appoint_id'];
            $doctorPrescription->from_doctor = $auth->id;
            $doctorPrescription->prescription = $request['prescription'];
            $doctorPrescription->set_reminder = $request['set_reminder'];
            $doctorPrescription->remarks = $request['remarks'];
            $doctorPrescription->save();

            /*$appointmentReminder = AppointmentReminder::where('id',$order_id)->with('feastDate','user')->first();
            //event(new AppointmentReminder($doctorPrescription));*/

            if($doctorPrescription->exists){
                // add notification
                Notification::create(array(
                    'receiver_id' => $nearBy[0]->id,
                    'receiver_type' => 'pharmist',
                    'sender_id' => $auth->id,
                    'sender_type' => 'doctor',
                    'object' => 'send',
                    'verb' => 'request',
                    'message' => "Hi {{name}}, update the prescription for you",
                    'metadata' => json_encode(array(
                        'type' => 'prescription_send',
                        'user_id' => $auth->id,
                        'return_id' => $doctorPrescription->id,
                        'name' => $auth->name
                    )),
                ));

             $full_name = $nearBy[0]->name;
            $subject = "Prescription update request";

            $this->sendEmail('auth.emails.prescription_update', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $nearBy[0]->email, $this->_fromName);

            $patient = User::find($request['to_patient']);
            // If patient has default pharmacy, send mail to default pharmacy
            if($patient && $pharma = $patient->hasDefaultPharmacy()){
              $this->sendEmail('auth.emails.prescription_update', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $pharma->email, $this->_fromName);
            }

            }else{

                // add notification
                        Notification::create(array(
                            'receiver_id' => $nearBy[0]->id,
                            'receiver_type' => 'pharmist',
                            'sender_id' => $auth->id,
                            'sender_type' => 'doctor',
                            'object' => 'send',
                            'verb' => 'request',
                            'message' => "Hi {{name}}, prescription for you",
                            'metadata' => json_encode(array(
                                'type' => 'prescription_send',
                                'user_id' => $auth->id,
                                'return_id' => $doctorPrescription->id,
                                'name' => $auth->name
                            )),
                        ));

            $full_name = $nearBy[0]->name;
            $subject = "Prescription Request";

            $this->sendEmail('auth.emails.prescription_request', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $nearBy[0]->email, $this->_fromName);


            $full_name = $request['patient_name'];
            $subject = "Doctor has written the prescriptions";

            $this->sendEmail('auth.emails.doctor_prescription', ["full_name" => $full_name, "doctor" => $auth->name], $subject, $request['patient_email'], $this->_fromName);

        }
        return redirect()->route('admin.docappoint_setting.index')->with('status', 'Prescription send successfully to ' . $nearBy[0]->name);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $auth = Auth::user();
        $appointment_seen = AppointmentRequest::find($id);
        $appointment_seen->seen = 'Seen';
        $appointment_seen->save();


        $appointment_detail = AppointmentRequest::where('id', $id)->first()->load('users','prescription');


        return view('admin.user.doctor_appointment.show', compact('appointment_detail', 'auth'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function format(Request $request)
    {
        $medical_history_seen = User::find(Auth::user()->id);
        $medical_history_seen->seen = 'Seen';
        $medical_history_seen->save();

        return redirect()->route('admin.patient.history');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

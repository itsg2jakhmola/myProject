<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\DoctorPrescription;
use App\PharmistRequest;
use App\Notification;
use App\PharmaTracking;
use App\Http\Requests;
use App\User;
use Auth;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\EmailTrait;

class PharmacyController extends Controller
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

        if($auth->user_type == 1){
            $prescription_list = DoctorPrescription::where('for_patient', $auth->id)->orderBy('created_at', 'DESC')->get()->load('doctor', 'pharmist', 'booking_request'); 
            
        }
        if($auth->user_type == 2){
            $prescription_list = DoctorPrescription::where('from_doctor', $auth->id)->orderBy('created_at', 'DESC')->get()->load('doctor');    
        }
        if($auth->user_type == 3){
            $prescription_list = DoctorPrescription::where('to_pharmist', $auth->id)->orderBy('created_at', 'DESC')->get()->load('doctor');    
        }
        
    

        return view('admin.user.prescription.index', compact('prescription_list'));   
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
    public function store(Request $request)
    {

        $patient = User::find($request->patient_id);
        $auth = Auth::user();
        //$pharmaTracking = PharmaTracking::create($request->all());
        $pharmaTracking = PharmaTracking::firstOrNew([
               'appointment_id' => $request->appointment_id 
        ]);   

        $pharmaTracking->appointment_id =  $request->appointment_id;
        $pharmaTracking->doctor_id =  $request->doctor_id;
        $pharmaTracking->patient_id =  $request->patient_id;
        $pharmaTracking->packed_date =  $request->packed_date;
        $pharmaTracking->pack_time = $request->pack_time;
        $pharmaTracking->pharma_name = $request->pharma_name;
        $pharmaTracking->amount = $request->amount;
        $pharmaTracking->save();


        // add notification
        Notification::create(array(
            'receiver_id' => $patient->id,
            'receiver_type' => 'patient',
            'sender_id' => $auth->id,
            'sender_type' => 'pharmist',
            'object' => 'send',
            'verb' => 'tracking',
            'message' => "Hi {{name}} has sent your prescription tracking",
            'metadata' => json_encode(array(
                'type' => 'send_tracking',
                'user_id' => $auth->id,
                'name' => $auth->name
            )),
        ));

        $full_name = $patient->name;
        $subject = "Your Prescription is ready ";

        $this->sendEmail('auth.emails.prescription_done', ["full_name" => $full_name, "pharmist" => $auth], $subject, $patient->email, $this->_fromName);

        return redirect()->route('admin.pharmist_setting.index')->with('status', 'Prescription ready for patient');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $prescription_seen = DoctorPrescription::find($id);
        $prescription_seen->seen = 'Seen';
        $prescription_seen->save();

        $prescription_detail = DoctorPrescription::where('id', $id)->first()->load('doctor', 'patient', 'pharmist', 'tracking', 'booking_request');
        
        
        return view('admin.user.prescription.show', compact('prescription_detail', 'user'));
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
            $auth = Auth::user();    

            $this->validate($request, [
                'alternate_prescription'     => 'required',
            ]);

            $pharmistRequest = DoctorPrescription::find($id);

            $pharmistRequest->alternate_prescription = $request['alternate_prescription'];

            $pharmistRequest->save();

             // add notification
            Notification::create(array(
                'receiver_id' => $pharmistRequest->from_doctor,
                'receiver_type' => 'doctor',
                'sender_id' => $auth->id,
                'sender_type' => 'pharmist',
                'object' => 'alternate',
                'verb' => 'prescription',
                'message' => "Hi {{name}} has request for alternate prescription",
                'metadata' => json_encode(array(
                    'type' => 'alternate_prescription',
                    'user_id' => $auth->id,
                    'return_id' => $request->appointment_request_id,
                    'name' => $auth->name
                )),
            ));

            return redirect()->route('admin.pharmist_setting.index')->with('status', 'Alternate Prescription send successfully');

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

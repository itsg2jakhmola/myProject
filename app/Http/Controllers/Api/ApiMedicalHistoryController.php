<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Medicalhistory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ApiMedicalHistoryController extends Controller
{
    public function createMedicalHistory(Request $request) {
    		
    		$validator = \Validator::make($request->all(), [
    				'name' => 'required',
    				'description' => 'required',
    				'medical_scan' => 'required| mimes:jpeg,jpg,png,gif',
    				'medical_scan_dt' => 'required',
    			]);

    		if($validator->fails()){
    			return response()->json($validator->messages(), 401);
    		}

    		 if( $request->hasFile('medical_scan') ) {

                $medical_scan = $request->file('medical_scan');

                $fileName = time() . '_' . $medical_scan->getClientOriginalName();

                $destination = public_path() . '/images/medicalhistory/';
                $medical_scan->move($destination, $fileName);

                $medicalHistory = new Medicalhistory;
                $medicalHistory->fill($request->all());
                $medicalHistory->medical_scan = $fileName;
                $medicalHistory->name    = $request->input('name');
                $medicalHistory->description = $request->input('description');
                $medicalHistory->medical_scan_path = '/images/medicalhistory/' . $fileName;
                $medicalHistory->medical_scan_dt = $request->input('medical_scan_dt');               
                $medicalHistory->save();
            }

            return response()->json(['message' => 'Your Medical History Saved Successfully']);
    }

    public function showMedicalhistory($id)
    {
    	$medical_detail = Medicalhistory::where('id', $id)->first();
     	return response()->json(compact('medical_detail'));   
    }

    public function editMedicalHistory($id)
    {
         $medicalhistory = Medicalhistory::find($id);
	     return response()->json(compact('medicalhistory'));
    }

    public function removeMedicalHistory($id) {
    	 $medicalhistory = Medicalhistory::findOrFail($id);
         $medicalhistory->delete();

         return response()->json(['message' => 'Medical History Successfully Deleted']);
    }

    public function updateMedicalHistory(Request $request, $id)
    {

         	$rules = [
         		'name' => 'required',
         		'description' => 'required'
         	];

         	$validator = \Validator::make($request->all(), $rules);

         	//If validation fails
         	if ($validator->fails()) {    
		   		 return response()->json($validator->messages(), 401);
			}
            
           $medical_history = Medicalhistory::find($id);
           $medical_history->fill($request->all());
           
            /*if($request->medical_scan || !$medical_history->medical_scan){
         		$rules['medical_scan']   => 'required | mimes:jpeg,jpg,png,gif,svg',
         	}*/


            $medical_history->name = $request->input('name');
            $medical_history->description = $request->input('description');
            $medical_history->medical_scan_dt = $request->input('medical_scan_dt'); 
            $medical_history->save();
            
            if ($request->hasFile('medical_scan')) {
                $medical_scan = $request->file('medical_scan');

                $fileName = time() . '_' . $medical_scan->getClientOriginalName();

                $destination = public_path() . '/images/medicalhistory/';
                $medical_scan->move($destination, $fileName);

                $medical_history->medical_scan = $fileName;
                $medical_history->medical_scan_path = '/images/medicalhistory/' . $fileName;
                
                $medical_history->save();
            }

            return response()->json(['Response' => 'Well done!! Medical history detail updated successfully']);
    }
}

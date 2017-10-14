<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Medicalhistory;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MedicalHistoryController extends Controller
{

    //protected $_gallery_path,

    const GALLERY_PATH = 'images/medicalhistory/';

    public function __construct()
    {
        $this->imagePath();
    }

     function imagePath() {
        $this->_gallery_path = public_path(self::GALLERY_PATH);
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $medical_detail = Medicalhistory::orderBy('created_at', 'DESC')->get();
        return view('admin.user.medical_history', compact('medical_detail'));    
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.medical_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    
    {
        $medicalHistory = $request->all();

            $this->validate($request, [
                'name'     => 'required',
                'description'  => 'required',
                'medical_scan'   => 'required | mimes:jpeg,jpg,png,gif,svg',
            ]);

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

           return redirect()->route('admin.medical_history.index')->with("status", "Medical History successfully saved");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $medical_detail = Medicalhistory::where('id', $id)->first();
        return view('admin.user.show', compact('medical_detail'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
         $medicalhistory = Medicalhistory::find($id);
        
     return \View::make('admin.user.edit')
        ->with(compact('medicalhistory'));
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

        //dd($request->all());
         $this->validate($request, [
                'name'     => 'required',
                'description'  => 'required',
                
            ]);

           $medical_history = Medicalhistory::find($id);
            $medical_history->fill($request->all());
            //image validation
            if($request->medical_scan || !$medical_history->medical_scan){
                $this->validate($request, [
                'medical_scan'   => 'required | mimes:jpeg,jpg,png,gif,svg',
                ]);
            }


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

           return redirect()->back()->with("status", "Well done!! Medical history detail updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalhistory = Medicalhistory::findOrFail($id);
         $medicalhistory->delete();

           return redirect()->back()->with("status", "Medical history successfully deleted");
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Alergichistory;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

class AlergicHistoryController extends Controller
{

    //protected $_gallery_path,

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $active = 'active';
        $alergy_detail = Alergichistory::orderBy('created_at', 'DESC')
                        ->where('user_id', Auth::user()->id)->get();
        return view('admin.user.alergy.alergy_history', compact('alergy_detail', 'active'));    
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.alergy_form');
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
            ]);

           
                $medicalHistory = new Alergichistory;
                $medicalHistory->fill($request->all());
                $medicalHistory->user_id = Auth::user()->id;
                $medicalHistory->name    = $request->input('name');
                $medicalHistory->remarks = $request->input('description');
                $medicalHistory->save();
           

           return redirect()->route('admin.alergic_history.index')->with("status", "Allergy History successfully saved");
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
         $medicalhistory = Alergichistory::find($id);
        
     return \View::make('admin.user.alergy.edit')
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

           $medical_history = Alergichistory::find($id);
            $medical_history->fill($request->all());
            
            $medical_history->name = $request->input('name');
            $medical_history->remarks = $request->input('description');
            
            $medical_history->save();
            
            

           return redirect()->back()->with("status", "Well done!! Alergy history detail updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $medicalhistory = Alergichistory::findOrFail($id);
         $medicalhistory->delete();

           return redirect()->back()->with("status", "Medical history successfully deleted");
    }
}

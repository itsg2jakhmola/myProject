<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\User;
use App\DefaultUser;
use Auth;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class FindUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth = Auth::user();

        $userInfo = DefaultUser::where('user_id', $auth->id)->first();
        
        if($userInfo){
            $patientInfo = $auth->find($userInfo->assign_to_patient);
            $doctorInfo = $auth->find($userInfo->assign_to_doctor);
            $pharmistInfo = $auth->find($userInfo->assign_to_pharmist);    
        }else{
            $doctorInfo = null;
            $pharmistInfo = null;
        }
        
        return view('admin.user.suggest.index', compact('userInfo', 'doctorInfo', 'pharmistInfo', 'patientInfo'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function updateCreate(Request $request, $id=null)
    {
        /*$rules = array(
            'email' => 'required_without_all:email',
            'phone' => 'required_without_all:phone',
        );
        $validator = \Validator::make($request->all(), $rules);*/

           /* $this->validate($request, [
                'email'     => 'required_without_all:email,phone',
                'phone'  => 'required_without_all:email,phone',
            ]);*/
        if($request->user_type == 1){
                 $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone)
                                ->first();
        }
        if($request->user_type == 2){
                 $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone)
                                ->first();
        }if($request->user_type == 3){
             $user = User::where('email', $request->email)
                                ->orWhere('phone_number', $request->phone)
                                ->first();
        }
        
            $checkUser = DefaultUser::firstOrNew([
                'user_id' => Auth::user()->id
            ]);
            
         $checkUser->user_id = Auth::user()->id;

         if($user->user_type == 1){
             $checkUser->assign_to_patient = $user->id;
            }
         else if($user->user_type == 2){
             $checkUser->assign_to_doctor = $user->id;
            }
            else if($user->user_type == 3){
                $checkUser->assign_to_pharmist = $user->id;   
            }else{
                return redirect()->back()->with('status', 'Oh Snap! Something went wrong try again later');
            }
         $checkUser->save();

         return redirect()->back()->with('status', 'Your default doctor ' . $user->name . ' is saved');
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

    public function showUser(Request $request) {

         $this->validate($request, [
                'email'     => 'required_without_all:email,phone,doctor_practice,address',
                'phone'  => 'required_without_all:email,phone,doctor_practice,address',
                'doctor_practice'  => 'required_without_all:email,phone,doctor_practice,address',
                'address'  => 'required_without_all:email,phone,doctor_practice,address',
            ]);

    if(!empty($request->all() ) ){
        $querry = User::orderBy('id');

        if(!empty($request->doctor_practice)){
            $querry->where('doctor_practice',$request->doctor_practice);
        }
        if(!empty($request->phone)){
            $querry->where('phone_number',$request->phone);
        }
        if(!empty($request->email)){
            $querry->where('email',$request->email);
        }
        if(!empty($request->address)){
            $querry->where('address',$request->address);
        }

    $userDetail  = $querry->first();    
    //dd($userDetail);
    /*if($request->input('email')){
        $email = $request->input('email');
     }else{
        $email = null;
     }

     if($request->input('phone')){
        $phone = $request->input('phone');
     }else{
        $phone = null;
     } 

     if($request->input('doctor_practice')){
        $doctor_practice = $request->input('doctor_practice');
     }else{
        $doctor_practice = null;
     } 

     if($request->input('address')){
        $address = $request->input('address');
     }else{
        $address = null;
     }  

      $userDetail = User::where('email',  $email)
        ->orwhere(function ($query) use ($phone, $doctor_practice, $address){
            $query->orwhere('phone_number',  $phone)
                  ->orwhere('doctor_practice',  $doctor_practice)
                  ->orwhere('address', $address);
        })->first();*/
                
        if(!$userDetail){
            echo "Not found Please try again!";exit;
        }


       /* $userDetail = \DB::select("select * from `users` where (`email` = '".$request->input('email'). "' AND `phone_number` =  '".$request->input('phone_number')"') OR (`phone_number` =  '".$request->input('phone_number'). "' or `doctor_practice` = '".$request->input('doctor_practice')."' or `address` = '".$request->input('address')."') LIMIT 1");

        dd($userDetail);*/
        //echo $userDetail->toSql();

        return view('admin.user.suggest.show', compact('userDetail'));
      }
    
    }
}

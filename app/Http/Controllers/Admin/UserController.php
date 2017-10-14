<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Auth;
use App\Usertype;
use App\Http\Requests;
use DB;
use App\User;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
    	$user = Auth::user();
        $userId = intval($user->id);

    	$userType = Usertype::find($userId);
    	//$userType = Usertype::where('id', '=', $user->id)->first();
        
    	return view('admin.user.index', compact('user', 'userType'));

    }

    public function update(Request $request, $id)

    {

        $this->validate($request, [

            /*'title' => 'required',

            'description' => 'required',*/

        ]);



        User::find($id)->update($request->all());

        return redirect()->back()

                        ->with('success','Item updated successfully');

    }
}

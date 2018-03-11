<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\PharmaTracking;
use App\UserRating;
use App\Http\Controllers\Controller;

class ReviewController extends Controller
{
    public function index()
    {
    	$orders = PharmaTracking::with('doctor')->get();
    	
    	return view('admin.user.review', compact('orders'));
    }

    public function show($id)
    {

        $review = PharmaTracking::with('doctor', 'userReview')->where('appointment_id', $id)->first();
        
        
        return view('admin.user.orders.show', compact('review'));
    }

    public function review(Request $request, $id)
    {

    	$auth = Auth::user();

    	$this->validate($request, [
                'comment'     => 'required'
            ]);

    	$postReview = UserRating::firstOrNew([
    			'user_id' => $auth->id,
    			'appointment_id' => $request->appointment_id
    		]);

    		$postReview->user_id = $auth->id;
    		$postReview->appointment_id = $request->appointment_id;
    		$postReview->rating = $request->rating;
    		$postReview->review = $request->comment;
           
            $postReview->save();

            return redirect()->back()->with('status', ' I appreciate your time thanking you for posting review ');
    }
}

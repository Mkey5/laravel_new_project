<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

use Image;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //
    public function profile(){
    	return view('profile', array('user'=> Auth::user()));
    }

    public function update_avatar(Request $request){
    	// Handle the user request for new avatar
    	// We are gonna use pacage User Intervention

    	if($request->hasFile('avatar')){

    		$avatar = $request->file('avatar');


    		// Build the input for validation
		    $fileArray = array('image' => $avatar);

		    // Tell the validator that this file should be an image
		    $rules = array(
		      'image' => 'mimes:jpeg,jpg,png,gif|required|max:10000' // max 10000kb
		    );

		    // Now pass the input and rules into the validator
		    $validator = Validator::make($fileArray, $rules);

		    // Check to see if validation fails or passes
		    if ($validator->fails()){
		          // Redirect or return json to frontend with a helpful message to inform the user 
		          // that the provided file was not an adequate type
		          return view('profile',array(
		          	// 'error' => response()->json(['error' => $validator->errors()->getMessages()], 400) ,
		          	'error' => $validator->errors()->getMessages(), 
		          	'user' => Auth::user()
		          	));
		    } else{
		        // Store the File Now
		        // read image from temporary file
		        
		    	$filename = time() . '.' . $avatar->getClientOriginalExtension(); // give the file custom name so that the img has unique name 
	    		Image::make($avatar)->resize(300,300)->save( public_path('/uploads/avatars/' . $filename) );

	    		// for updating database , the new path to the new avatar
	    		$user = Auth::user();
	    		$user->avatar = $filename;
	    		$user->save();

	    		return view('profile', array(
	    			'user'=> Auth::user()
	    			));

		    };


    	}

    }

}

<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;

class RegistersteptwoController extends Controller
{
	function stepTwoIndex(){
		return view('registersteptwo', array('user' => Auth::user())); 
	}

    function createDefaultGameClasses(Request $request){
    	$homeplanet_name = $request->get('homeplanet_name', null); // get input , if empty make null
    	$orbitalbase_name = $request->get('orbitalbase_name',null);
    	$fleet_name = $request->get('fleet_name',null);

    	// check if all inputs aren't empty
    	if(!is_null($homeplanet_name) && !is_null($orbitalbase_name) && !is_null($fleet_name)){
    		$currentUser = Auth::user();
    		// create the default classes
    	}else{
    		return view('registersteptwo', array('user' => Auth::user()));
    	}


    	// $currentUser = Auth::user();
     //        $currentUser->step2 = 1;
     //        $currentUser->save();
    }
}

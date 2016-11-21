<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeplanetController extends Controller
{
    public function homeplanetIndex(){
    	return view('homeplanet',array(
    		'user' => Auth::user()
    		));
    }

    public function homeplanetUpgrade(Request $request){
    	if($request->input('gold_upgrating')){
    		// TODO-MAK add timer . . .

    		return view('homeplanet',array(
    		'user' => Auth::user()
    		));
    	}else if($request->input('metal_upgrating')){
    		// TODO-MAK add timer . . . 

    		return view('homeplanet',array(
    		'user' => Auth::user()
    		));
    	}else if($request->input('energy_upgrating')){
    		// TODO-MAK add timer . . .

    		return view('homeplanet',array(
    		'user' => Auth::user()
    		)); 
    	}else{
    		return view('homeplanet',array(
    		'user' => Auth::user()
    		));
    	}
    	
    }
}

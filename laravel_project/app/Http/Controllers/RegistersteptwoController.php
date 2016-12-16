<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Homeplanet;
use App\Orbitalbase;
use App\Fleet;
use App\Goldmine;
use App\Metalmine;
use App\Powerplant;
use App\Shipyard;

class RegistersteptwoController extends Controller
{
	function stepTwoIndex(){
		return view('registersteptwo', array(
			'user' => Auth::user(), 
			'errors' => array()
			)); 
	}

    function createDefaultGameClasses(Request $request){
    	$homeplanet_name = $request->get('homeplanet_name', null); // get input , if empty make null
    	$galaxy = $request->get('galaxy',null);
    	$orbitalbase_name = $request->get('orbitalbase_name',null);
    	$fleet_name = $request->get('fleet_name',null);



    	// check if all inputs aren't empty
    	if(!is_null($homeplanet_name) && !is_null($orbitalbase_name) && !is_null($fleet_name)){
    		
    		// Validation

    		/* 

    		If we want to use the default Validation build in Laravel , we need to build 3 seperately validators,because we validate input not for 1 but for 3 tables , and the names of the columns are the same 'name' 
	
    		 */

    		// Build a validation array for homeplanet
    		$inputHomeplanet = array(
    			'name' => $homeplanet_name,
    			'galaxy' => $galaxy
    			 );

    		// Build a validation array for orbitalbase
    		$inputOrbitalbase = array(
    			'name' => $orbitalbase_name
    			 );

    		// Build a validation array for fleet
    		$inputFleet = array(
    			'name' => $fleet_name
    			 );


    		// Build a validator rules for homeplanet
    		$rulesHomeplanet = array(
    			'name' => 'required|max:255|unique:homeplanets',
    			'galaxy' => 'required'
    			);

    		// Build a validator rules for orbitalbase
    		$rulesOrbitalbase = array(
    			'name' => 'required|max:255|unique:orbitalbases'
    			);

    		// Build a validator rules for fleet
    		$rulesFleet = array(
    			'name' => 'required|max:255|unique:fleets'
    			);


    		// Passing the input and rules to the Validator for homeplanet
    		$validatorHomeplanet = Validator::make($inputHomeplanet , $rulesHomeplanet);

    		// Passing the input and rules to the Validator for orbitalbase
    		$validatorOrbitalbase = Validator::make($inputOrbitalbase , $rulesOrbitalbase);

    		// Passing the input and rules to the Validator for orbitalbase
    		$validatorFleet = Validator::make($inputFleet , $rulesFleet);

    		//check if the validation went well
    		if($validatorHomeplanet->fails()){
    			return view('registersteptwo', array(
    				'user' => Auth::user(),
    				'errors' => array(
    					'homeplanet_name' => $validatorHomeplanet->errors()->getMessages()
    					) 
    				));
    		}else if($validatorOrbitalbase->fails()){
    			return view('registersteptwo', array(
    				'user' => Auth::user(),
    				'errors' => array(
    					'orbitalbase_name' => $validatorOrbitalbase->errors()->getMessages()
    					)
    				));
    				
    		}else if($validatorFleet->fails()){
    			return view('registersteptwo', array(
    				'user' => Auth::user(),
    				'errors' => array(
    					'fleet_name' => $validatorFleet->errors()->getMessages()
    					)
    				));
    		}else{

    			$currentUser = Auth::user();

    			// adding homeplanet
    			$homeplanet = new Homeplanet;
    			$homeplanet->user_id = $currentUser->id;
    			$homeplanet->name = $homeplanet_name;
    			$homeplanet->createCoordinates($galaxy); // TODO !
    			$homeplanet->save();

    			$orbitalbase = new Orbitalbase;
    			$orbitalbase->user_id = $currentUser->id;
    			$orbitalbase->name = $orbitalbase_name;
    			$orbitalbase->save();

    			$fleet = new Fleet;
    			$fleet->user_id = $currentUser->id;
    			$fleet->name = $fleet_name;
    			$fleet->save();

    			$goldmine = new Goldmine;
    			$goldmine->homeplanet_id = $homeplanet->id;
                $goldmine->upgrating_time = '0001-01-01 00:00:00';
    			$goldmine->save();

    			$metalmine = new Metalmine;
    			$metalmine->homeplanet_id = $homeplanet->id;
                $metalmine->upgrating_time = '0001-01-01 00:00:00';
    			$metalmine->save();

    			$powerplant = new Powerplant;
    			$powerplant->homeplanet_id = $homeplanet->id;
                $powerplant->upgrating_time = '0001-01-01 00:00:00';
    			$powerplant->save();

    			$shipyard = new Shipyard;
    			$shipyard->orbitalbase_id = $orbitalbase->id;
                $shipyard->upgrating_time = '0001-01-01 00:00:00';
                $shipyard->frigate_time = '0001-01-01 00:00:00';
                $shipyard->corvette_time = '0001-01-01 00:00:00';
                $shipyard->destroyer_time = '0001-01-01 00:00:00';
                $shipyard->assaultcarrier_time = '0001-01-01 00:00:00';

    			$shipyard->save();

    			// DISABLE THE ACCESS FOR THIS PAGE :
    			$currentUser->step2 = 1;
    			$currentUser->save();

    			return view('home' , array(
    				'user' => $currentUser
    				));

    		}

    	}else{
    		return view('registersteptwo', array(
    			'user' => Auth::user() , 
    			'errors' => array()
    			));
    	}



    }
}

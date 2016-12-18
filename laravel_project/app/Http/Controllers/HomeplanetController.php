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
    	date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	if($request->input('gold_upgrating')){
    		$currentGoldLevel = $currentUser->homeplanet->goldmine->level; // mine level
    		$timeToUpgrade = 60 * $currentGoldLevel;	// time to upgrade

    		
    		if( ($currentUser->homeplanet->gold >= $currentUser->homeplanet->goldmine->cost_gold) &&
    			($currentUser->homeplanet->metal >= $currentUser->homeplanet->goldmine->cost_metal) &&
    			($currentUser->homeplanet->energy >= $currentUser->homeplanet->goldmine->cost_energy)){ // check if user has enough money to upgrade

    			\App\Goldmine::where('homeplanet_id','=',$currentUser->homeplanet->id)->update([
				 'upgrating_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $currentUser->homeplanet->goldmine->cost_gold;
    			$currentUser->homeplanet->metal -= $currentUser->homeplanet->goldmine->cost_metal;
    			$currentUser->homeplanet->energy -= $currentUser->homeplanet->goldmine->cost_energy;
    			$currentUser->homeplanet->save();

    		}else{

    			return redirect()->back(); //redirects and refreshes
    		}


			return redirect()->back(); //redirects and refreshes	
    		
    	}else if($request->input('metal_upgrating')){
    		$currentMetalLevel = $currentUser->homeplanet->metalmine->level; // mine level
    		$timeToUpgrade = 60 * $currentMetalLevel;	// time to upgrade

			

			if( ($currentUser->homeplanet->gold >= $currentUser->homeplanet->metalmine->cost_gold) &&
    			($currentUser->homeplanet->metal >= $currentUser->homeplanet->metalmine->cost_metal) &&
    			($currentUser->homeplanet->energy >= $currentUser->homeplanet->metalmine->cost_energy)){ // check if user has enough money to upgrade

    			\App\Metalmine::where('homeplanet_id','=', $currentUser->homeplanet->id)->update([
				 'upgrating_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $currentUser->homeplanet->metalmine->cost_gold;
    			$currentUser->homeplanet->metal -= $currentUser->homeplanet->metalmine->cost_metal;
    			$currentUser->homeplanet->energy -= $currentUser->homeplanet->metalmine->cost_energy;
    			$currentUser->homeplanet->save();

    		}else{

    			return redirect()->back(); //redirects and refreshes
    		}

    		return redirect()->back(); //redirects and refreshes	

    	}else if($request->input('energy_upgrating')){
    		$currentEnergyLevel = $currentUser->homeplanet->powerplant->level; // mine level
    		$timeToUpgrade = 60 * $currentEnergyLevel;	// time to upgrade

			
			if( ($currentUser->homeplanet->gold >= $currentUser->homeplanet->powerplant->cost_gold) &&
    			($currentUser->homeplanet->metal >= $currentUser->homeplanet->powerplant->cost_metal) &&
    			($currentUser->homeplanet->energy >= $currentUser->homeplanet->powerplant->cost_energy)){ // check if user has enough money to upgrade

    			\App\Powerplant::where('homeplanet_id','=', $currentUser->homeplanet->id)->update([
				 'upgrating_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $currentUser->homeplanet->powerplant->cost_gold;
    			$currentUser->homeplanet->metal -= $currentUser->homeplanet->powerplant->cost_metal;
    			$currentUser->homeplanet->energy -= $currentUser->homeplanet->powerplant->cost_energy;
    			$currentUser->homeplanet->save();

    		}else{

    			return redirect()->back(); //redirects and refreshes
    		}



    		return redirect()->back(); //redirects and refreshes	

    	}else{
    		return view('homeplanet',array(
    		'user' => Auth::user()
    		));
    	}
    	
    }
}

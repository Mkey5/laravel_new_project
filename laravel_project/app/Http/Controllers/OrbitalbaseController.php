<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Frigate;
use App\Corvette;
use App\Destroyer;
use App\Assaultcarrier;

class OrbitalbaseController extends Controller
{
	
	

    public function orbitalbaseIndex(){

    	return view('orbitalbase',array(
    		'user' => Auth::user() ,
    		'ships' => array(
    				'frigate' => array(
    					'cost_gold' => Frigate::$cost_gold ,
    					'cost_metal' => Frigate::$cost_metal ,
    					'cost_energy' => Frigate::$cost_energy ,
    					'levelneeded' => Frigate::$levelneeded ,
    					'attack' => Frigate::$attack_def ,
    					'defence' => Frigate::$defence_def 
    					) ,
    				'corvette' => array(
    					'cost_gold' => Corvette::$cost_gold ,
    					'cost_metal' => Corvette::$cost_metal ,
    					'cost_energy' => Corvette::$cost_energy ,
    					'levelneeded' => Corvette::$levelneeded ,
    					'attack' => Corvette::$attack_def ,
    					'defence' => Corvette::$defence_def 
    					) ,
    				'destroyer' => array( 
    					'cost_gold' => Destroyer::$cost_gold ,
    					'cost_metal' => Destroyer::$cost_metal ,
    					'cost_energy' => Destroyer::$cost_energy ,
    					'levelneeded' => Destroyer::$levelneeded ,
    					'attack' => Destroyer::$attack_def ,
    					'defence' => Destroyer::$defence_def 
    					) ,
    				'assaultcarrier' => array(
    					'cost_gold' => Assaultcarrier::$cost_gold ,
    					'cost_metal' => Assaultcarrier::$cost_metal ,
    					'cost_energy' => Assaultcarrier::$cost_energy ,
    					'levelneeded' => Assaultcarrier::$levelneeded ,
    					'attack' => Assaultcarrier::$attack_def ,
    					'defence' => Assaultcarrier::$defence_def
    					) 
    				)
    		));
    }

    public function orbitalbaseUpgradeOrCreate(Request $request){

    	if($request->input('shipyard_upgrating')){
    		return $this->UpgradeShipyard($request);
    	}elseif ($request->input('shipyard_create')) {
    		return $this->CreateShips($request);
    	}

    }

    public function UpgradeShipyard(Request $request){
    	date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	$currentShipyardLevel = $currentUser->orbitalbase->shipyard->level;
    	$timeToUpgrade = 60 * $currentShipyardLevel;

    	if( ($currentUser->homeplanet->gold >= $currentUser->orbitalbase->shipyard->cost_gold) &&
    			($currentUser->homeplanet->metal >= $currentUser->orbitalbase->shipyard->cost_metal) &&
    			($currentUser->homeplanet->energy >= $currentUser->orbitalbase->shipyard->cost_energy)){ // check if user has enough money to upgrade

    			\App\Shipyard::where('orbitalbase_id','=',Auth::id())->update([
				 'upgrating_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $currentUser->orbitalbase->shipyard->cost_gold;
    			$currentUser->homeplanet->metal -= $currentUser->orbitalbase->shipyard->cost_metal;
    			$currentUser->homeplanet->energy -= $currentUser->orbitalbase->shipyard->cost_energy;
    			$currentUser->homeplanet->save();

    		}




    	return redirect()->back(); //redirects and refreshes

    }

 	public function CreateShips(Request $request){

 		return redirect()->back(); //redirects and refreshes
 	}


}

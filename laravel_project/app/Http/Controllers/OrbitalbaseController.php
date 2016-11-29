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
    	}elseif ($request->input('create_frigate')) {
    		return $this->CreateFrigate($request);
    	}elseif ($request->input('create_corvette')) {
    		return $this->CreateCorvette($request);
    	}elseif ($request->input('create_destroyer')) {
    		return $this->CreateDestroyer($request);
    	}elseif ($request->input('create_assaultcarrier')) {
    		return $this->CreateAssaultcarrier($request);
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

    

 	public function CreateFrigate(Request $request){

 		date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	$frigateGold = Frigate::$cost_gold;
    	$frigateMetal = Frigate::$cost_metal;
    	$frigateEnergy = Frigate::$cost_energy;
    	$frigateLevelneeded = Frigate::$levelneeded;


    	$currentShipyardLevel = $currentUser->orbitalbase->shipyard->level;
    	$numberOfShips = $request->input('number_ships');
    	$timeToUpgrade = 5 * $numberOfShips;

    	if( ($currentUser->homeplanet->gold >= ($frigateGold * $numberOfShips)) &&
    			($currentUser->homeplanet->metal >= ($frigateMetal * $numberOfShips)) &&
    			($currentUser->homeplanet->energy >= ($frigateEnergy * $numberOfShips)) &&
    			($currentShipyardLevel >= $frigateLevelneeded) ){ // check if user has enough money to build or level

    			\App\Shipyard::where('orbitalbase_id','=',Auth::id())->update([
				 'frigate_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $frigateGold * $numberOfShips;
    			$currentUser->homeplanet->metal -= $frigateMetal * $numberOfShips;
    			$currentUser->homeplanet->energy -= $frigateEnergy * $numberOfShips;
    			$currentUser->homeplanet->save();

    			// creating the frigates
    			for ($i=0; $i < $numberOfShips ; $i++) { 
    				$newFrigate = new Frigate;
	    			$newFrigate->orbitalbase_id = $currentUser->id;
	    			$newFrigate->state = 'docked';
	    			$newFrigate->save();
    			}

    			return redirect()->back(); //redirects and refreshes

    		}else{
    			return $this->ErrorBuildingShip();
    		}

 		
 	}



 	public function CreateCorvette(Request $request){

 		date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	$CorvetteGold = Corvette::$cost_gold;
    	$CorvetteMetal = Corvette::$cost_metal;
    	$CorvetteEnergy = Corvette::$cost_energy;
    	$CorvetteLevelneeded = Corvette::$levelneeded;


    	$currentShipyardLevel = $currentUser->orbitalbase->shipyard->level;
    	$numberOfShips = $request->input('number_ships');
    	$timeToUpgrade = 15 * $numberOfShips;


    	if( ($currentUser->homeplanet->gold >= ($CorvetteGold * $numberOfShips)) &&
    			($currentUser->homeplanet->metal >= ($CorvetteMetal * $numberOfShips)) &&
    			($currentUser->homeplanet->energy >= ($CorvetteEnergy * $numberOfShips)) &&
    			($currentShipyardLevel >= $CorvetteLevelneeded) ){ // check if user has enough money to build or level

    			\App\Shipyard::where('orbitalbase_id','=',Auth::id())->update([
				 'corvette_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $CorvetteGold * $numberOfShips;
    			$currentUser->homeplanet->metal -= $CorvetteMetal * $numberOfShips;
    			$currentUser->homeplanet->energy -= $CorvetteEnergy * $numberOfShips;
    			$currentUser->homeplanet->save();

    			// creating the frigates
    			for ($i=0; $i < $numberOfShips ; $i++) { 
    				$newCorvette = new Corvette;
	    			$newCorvette->orbitalbase_id = $currentUser->id;
	    			$newCorvette->state = 'docked';
	    			$newCorvette->save();
    			}

    			return redirect()->back(); //redirects and refreshes

    		}else{
    			return $this->ErrorBuildingShip();
    		}

    }

    public function CreateDestroyer(Request $request){
    	
    	date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	$DestroyerGold = Destroyer::$cost_gold;
    	$DestroyerMetal = Destroyer::$cost_metal;
    	$DestroyerEnergy = Destroyer::$cost_energy;
    	$DestroyerLevelneeded = Destroyer::$levelneeded;


    	$currentShipyardLevel = $currentUser->orbitalbase->shipyard->level;
    	$numberOfShips = $request->input('number_ships');
    	$timeToUpgrade = 30 * $numberOfShips;


    	if( ($currentUser->homeplanet->gold >= ($DestroyerGold * $numberOfShips)) &&
    			($currentUser->homeplanet->metal >= ($DestroyerMetal * $numberOfShips)) &&
    			($currentUser->homeplanet->energy >= ($DestroyerEnergy * $numberOfShips)) &&
    			($currentShipyardLevel >= $DestroyerLevelneeded) ){ // check if user has enough money to build or level

    			\App\Shipyard::where('orbitalbase_id','=',Auth::id())->update([
				 'destroyer_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $DestroyerGold * $numberOfShips;
    			$currentUser->homeplanet->metal -= $DestroyerMetal * $numberOfShips;
    			$currentUser->homeplanet->energy -= $DestroyerEnergy * $numberOfShips;
    			$currentUser->homeplanet->save();

    			// creating the frigates
    			for ($i=0; $i < $numberOfShips ; $i++) { 
    				$newDestroyer = new Destroyer;
	    			$newDestroyer->orbitalbase_id = $currentUser->id;
	    			$newDestroyer->state = 'docked';
	    			$newDestroyer->save();
    			}

    			return redirect()->back(); //redirects and refreshes

    		}else{
    			return $this->ErrorBuildingShip();
    		}

    }

    public function CreateAssaultcarrier(Request $request){
    	
    	date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();

    	$AssaultcarrierGold = Assaultcarrier::$cost_gold;
    	$AssaultcarrierMetal = Assaultcarrier::$cost_metal;
    	$AssaultcarrierEnergy = Assaultcarrier::$cost_energy;
    	$AssaultcarrierLevelneeded = Assaultcarrier::$levelneeded;


    	$currentShipyardLevel = $currentUser->orbitalbase->shipyard->level;
    	$numberOfShips = $request->input('number_ships');
    	$timeToUpgrade = 60 * $numberOfShips;

    	if( ($currentUser->homeplanet->gold >= ($AssaultcarrierGold * $numberOfShips)) &&
    			($currentUser->homeplanet->metal >= ($AssaultcarrierMetal * $numberOfShips)) &&
    			($currentUser->homeplanet->energy >= ($AssaultcarrierEnergy * $numberOfShips)) &&
    			($currentShipyardLevel >= $AssaultcarrierLevelneeded) ){ // check if user has enough money to build or level

    			\App\Shipyard::where('orbitalbase_id','=',Auth::id())->update([
				 'assaultcarrier_time' => \Carbon\Carbon::now()->addMinutes($timeToUpgrade)
				]);	// updating 'upgrating_time' to DB

    			$currentUser->homeplanet->gold -= $AssaultcarrierGold * $numberOfShips;
    			$currentUser->homeplanet->metal -= $AssaultcarrierMetal * $numberOfShips;
    			$currentUser->homeplanet->energy -= $AssaultcarrierEnergy * $numberOfShips;
    			$currentUser->homeplanet->save();

    			// creating the frigates
    			for ($i=0; $i < $numberOfShips ; $i++) { 
    				$newAssaultcarrier = new Assaultcarrier;
	    			$newAssaultcarrier->orbitalbase_id = $currentUser->id;
	    			$newAssaultcarrier->state = 'docked';
	    			$newAssaultcarrier->save();
    			}

    			return redirect()->back(); //redirects and refreshes

    		}else{
    			return $this->ErrorBuildingShip();
    		}

    }

    public function ErrorBuildingShip(){
    	return view('orbitalbase',array(
    		'user' => Auth::user() ,
    		'errorBuild' => 'You could not afford to build those ships',
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





}

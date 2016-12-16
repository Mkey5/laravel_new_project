<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Frigate;
use App\Corvette;
use App\Destroyer;
use App\Assaultcarrier;
use App\Fleet;
use App\Orbitalbase;

class BattlestationController extends Controller
{
    public function battlestationIndex($user_id){
    	$currentUser = Auth::user();
    	$defender = User::where('id','=', $user_id)->first();

    	$battleInProgress = $currentUser->battles
    	->where('battle_time','!=' , '0001-01-01 00:00:00')
    	->where('attacker', '=' , $currentUser->id)
    	->first() ? true : false;

    	$timeToTravel = $this->calculateTravelTime($currentUser , $defender);

    	return view('battlestation' , array(
    			'user' => $currentUser ,
    			'defender' => $defender ,
    			'defender_time_range' => $timeToTravel ,
    			'battleInProgress' => $battleInProgress 
    		));
	}


	public function battlestationHandling(Request $request){
		if($request->input('prepare_fleet')){
		   return $this->battlestationPrepareFleet($request);
		}elseif ($request->input('abort')) {
			return $this->battlestationAbort();
		}elseif ($request->input('attack')){
			return $this->battlestationAttack($request); 
		}
	}

	public function battlestationPrepareFleet(Request $request){
		session_start();
		$_SESSION["fleet"] = false;
		$_SESSION["radar"] = false;

		$currentUser = Auth::user();

		$frigatesToSend = $request->input('frigates') ? $request->input('frigates') : 0;
		$corvettesToSend = $request->input('corvettes') ? $request->input('corvettes') : 0;
		$destroyersToSend = $request->input('destroyers') ? $request->input('destroyers') : 0;
		$assaultcarriersToSend = $request->input('assaultcarriers') ? $request->input('assaultcarriers') : 0;

		$dockedFrigates = $currentUser->orbitalbase->frigates ;
		$dockedCorvettes = $currentUser->orbitalbase->corvettes;
		$dockedDestroyers = $currentUser->orbitalbase->destroyers;
		$dockedAssaultcarriers = $currentUser->orbitalbase->assaultcarriers;

		$dockedLeftFrigates = $dockedFrigates - $frigatesToSend;
		$dockedLeftCorvettes = $dockedCorvettes - $corvettesToSend;
		$dockedLeftDestroyers = $dockedDestroyers - $destroyersToSend;
		$dockedLeftAssault_carriers = $dockedAssaultcarriers - $assaultcarriersToSend;

		$FleetAttack = ($frigatesToSend * Frigate::$attack_def) +
										($corvettesToSend * Corvette::$attack_def) +
											($destroyersToSend * Destroyer::$attack_def) +
												($assaultcarriersToSend * Assaultcarrier::$attack_def);

		$FleetDefence = ($frigatesToSend * Frigate::$defence_def) +
										($corvettesToSend * Corvette::$defence_def) +
											($destroyersToSend * Destroyer::$defence_def) +
												($assaultcarriersToSend * Assaultcarrier::$defence_def); 	
		

		Fleet::where('user_id','=',$currentUser->id)->update([
				 'frigate' => $frigatesToSend,
				 'corvette' => $corvettesToSend,
				 'destroyer' => $destroyersToSend,
				 'assault_carrier' => $assaultcarriersToSend,
				 'attack' => $FleetAttack,
				 'defence' => $FleetDefence ,
				 'state' => 'ready'
				]);

		Orbitalbase::where('user_id','=',$currentUser->id)->update([
				 'frigates' => $dockedLeftFrigates ,
				 'corvettes' => $dockedLeftCorvettes ,
				 'destroyers' => $dockedLeftDestroyers ,
				 'assaultcarriers' => $dockedLeftAssault_carriers
				]);


		// var_dump(session('test'))
  		// return back()->with('test', $frigatesToSend); returning data with session 

		return back();

	}


	public function battlestationAbort(){

		$currentUser = Auth::user();
		$dockedFrigates = $currentUser->orbitalbase->frigates;
		$dockedCorvettes = $currentUser->orbitalbase->corvettes;
		$dockedDestroyers = $currentUser->orbitalbase->destroyers;
		$dockedAssaultcarriers = $currentUser->orbitalbase->assaultcarriers;

		$fleetFrigates = $currentUser->fleet->frigate;
		$fleetCorvettes = $currentUser->fleet->corvette;
		$fleetDestroyers = $currentUser->fleet->destroyer;
		$fleetAssaultcarriers = $currentUser->fleet->assault_carrier;

		$frigatesAll = $dockedFrigates + $fleetFrigates;
		$corvettesAll = $dockedCorvettes + $fleetCorvettes;
		$destroyersAll = $dockedDestroyers + $fleetDestroyers;
		$assaultcarriersAll = $dockedAssaultcarriers + $fleetAssaultcarriers;

		

		Orbitalbase::where('user_id','=',$currentUser->id)->update([
				 'frigates' => $frigatesAll ,
				 'corvettes' => $corvettesAll ,
				 'destroyers' => $destroyersAll ,
				 'assaultcarriers' => $assaultcarriersAll
				]);

		Fleet::where('user_id','=',$currentUser->id)->update([
				 'frigate' => 0 ,
				 'corvette' => 0 ,
				 'destroyer' => 0 ,
				 'assault_carrier' => 0 ,
				 'attack' => 0 ,
				 'defence' => 0 ,
				 'state' => 'orbiting'
				]);

		return back()->withInput();

	}

	


	public function battlestationAttack(Request $request){
		date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();
    	$defender_id = $request->input('defender_id');
    	$defender = User::where('id','=', $defender_id)->first();

    	$timeToTravel = $this->calculateTravelTime($currentUser , $defender);

	    $battle = new \App\Battle;
	    $battle->attacker = $currentUser->id;
	    $battle->defender = $defender->id;
	    $battle->battle_time = \Carbon\Carbon::now()->addMinutes($timeToTravel+3); 
	    $battle->return_time = \Carbon\Carbon::now()->addMinutes($timeToTravel * 2);
		$battle->save();

		$battle->users()->sync([$currentUser->id , $defender->id ],false); // takes the id of the user to sync in the pivot table
		return back()->withInput();
	}


	public function calculateTravelTime($user , $defender){
		$attacker_x = $user->homeplanet->x; 
    	$attacker_y = $user->homeplanet->y;

    	$defender_x = $defender->homeplanet->x;
    	$defender_y = $defender->homeplanet->y;

    	$xCalc = abs($attacker_x - $defender_x);
    	$yCalc = abs($attacker_y - $defender_y);

    	$time = $xCalc + $yCalc;
		return $time;
	}
}

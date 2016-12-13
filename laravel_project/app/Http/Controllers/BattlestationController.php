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
    	->where('battle_time','!=' ,null)
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
		   return $this->battlestationPrepareFleet();
		}elseif ($request->input('abort')) {
			return $this->battlestationAbort();
		}elseif ($request->input('attack')){
			return $this->battlestationAttack($request); 
		}
	}

	public function battlestationPrepareFleet(){
		session_start();
		$_SESSION["fleet"] = false;
		$_SESSION["radar"] = false;

		$currentUser = Auth::user();
		$dockedFrigates = $currentUser->orbitalbase->frigates ;
		$dockedCorvettes = $currentUser->orbitalbase->corvettes;
		$dockedDestroyers = $currentUser->orbitalbase->destroyers;
		$dockedAssaultcarriers = $currentUser->orbitalbase->assaultcarriers;

		$FleetFrigates = $dockedFrigates;
		$FleetCorvettes = $dockedCorvettes;
		$FleetDestroyers = $dockedDestroyers;
		$FleetAssault_carriers = $dockedAssaultcarriers;
		$FleetAttack = ($dockedFrigates * Frigate::$attack_def) +
										($dockedCorvettes * Corvette::$attack_def) +
											($dockedDestroyers * Destroyer::$attack_def) +
												($dockedAssaultcarriers * Assaultcarrier::$attack_def);

		$FleetDefence = ($dockedFrigates * Frigate::$defence_def) +
										($dockedCorvettes * Corvette::$defence_def) +
											($dockedDestroyers * Destroyer::$defence_def) +
												($dockedAssaultcarriers * Assaultcarrier::$defence_def); 	
		

		Fleet::where('user_id','=',$currentUser->id)->update([
				 'frigate' => $FleetFrigates,
				 'corvette' => $FleetCorvettes,
				 'destroyer' => $FleetDestroyers,
				 'assault_carrier' => $FleetAssault_carriers,
				 'attack' => $FleetAttack,
				 'defence' => $FleetDefence ,
				 'state' => 'ready'
				]);

		Orbitalbase::where('user_id','=',$currentUser->id)->update([
				 'frigates' => 0 ,
				 'corvettes' => 0 ,
				 'destroyers' => 0 ,
				 'assaultcarriers' => 0
				]);



    	return back()->withInput();


	}


	public function battlestationAbort(){

		$currentUser = Auth::user();
		$dockedFrigates = $currentUser->fleet->frigate ;
		$dockedCorvettes = $currentUser->fleet->corvette;
		$dockedDestroyers = $currentUser->fleet->destroyer;
		$dockedAssaultcarriers = $currentUser->fleet->assault_carrier;

		

		Orbitalbase::where('user_id','=',$currentUser->id)->update([
				 'frigates' => $dockedFrigates ,
				 'corvettes' => $dockedCorvettes ,
				 'destroyers' => $dockedDestroyers ,
				 'assaultcarriers' => $dockedAssaultcarriers
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
	    // $battle->battle_time = \Carbon\Carbon::now()->addMinutes($timeToTravel+3); 
	    // $battle->return_time = \Carbon\Carbon::now()->addMinutes($timeToTravel * 2);
	    $battle->battle_time = \Carbon\Carbon::now()->addMinutes(1); 
	    $battle->return_time = \Carbon\Carbon::now()->addMinutes(10);
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

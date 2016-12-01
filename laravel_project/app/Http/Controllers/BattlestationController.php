<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;

class BattlestationController extends Controller
{
    public function battlestationIndex($user_id){
    	$currentUser = Auth::user();
    	$defender = User::where('id','=', $user_id)->first();

    	return view('battlestation' , array(
    			'user' => $currentUser ,
    			'defender' => $defender
    		));
    	
		
	}

	public function battlestationAttack($user_id){
		date_default_timezone_set('Europe/Bucharest');
    	$currentUser = Auth::user();
    	$defender = User::where('id','=', $user_id)->first();

    	$attacker_x = $currentUser->homeplanet->x; 
    	$attacker_y = $currentUser->homeplanet->y;

    	$defender_x = $defender->homeplanet->x;
    	$defender_y = $defender->homeplanet->y;

    	$xCalc = abs($attacker_x - $defender_x);
    	$yCalc = abs($attacker_y - $defender_y);

    	$timeToTravel = $xCalc + $yCalc;

	    $battle = new \App\Battle;
	    $battle->attacker = $currentUser->id;
	    $battle->defender = $user_id;
	    $battle->battle_time = \Carbon\Carbon::now()->addMinutes($timeToTravel+3);
		$battle->save();

		$battle->users()->sync([$currentUser->id , $defender->id ],false); // takes the id of the user to sync in the pivot table
	}
}

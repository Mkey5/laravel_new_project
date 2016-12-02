<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class BattleInProgressController extends Controller
{

	public function __construct(){
		$this->middleware('battle');
	}

    public function index(){
    	$currentUser = Auth::user();

    	$battleInProgress = $currentUser->battles
    	->where('battle_time','!=' ,null)
    	->where('attacker', '=' , $currentUser->id)
    	->first();

    	date_default_timezone_set('Europe/Bucharest');
    	$time = $battleInProgress->battle_time;
	    $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('Y');
	    $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('m');
	    $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('d');
	    $hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H');
	    $minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('i');
	    $second = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('s');


	    

    	return view('battleinprogress',array(
    		'user' => $currentUser,
    		'year' => $year,
    		'month' => $month,
    		'day' => $day,
    		'hour' => $hour,
    		'minute' => $minute,
    		'second' => $second
    		));
    }
}

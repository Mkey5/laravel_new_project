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
    	return view('battleinprogress',array(
    		'user' => Auth::user()
    		));
    }
}

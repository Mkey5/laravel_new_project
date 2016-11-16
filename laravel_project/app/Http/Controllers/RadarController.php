<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use Illuminate\Http\Request;

class RadarController extends Controller
{
    public function radarIndex(){
    	return view('radar',array(
    			'user' => Auth::user(),
    			'allUsers' => User::where('id', '!=', Auth::id())->get() //all users except the current user
    		));
    }
}

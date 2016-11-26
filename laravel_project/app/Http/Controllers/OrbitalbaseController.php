<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class OrbitalbaseController extends Controller
{
    public function orbitalbaseIndex(){

    	return view('orbitalbase',array(
    		'user' => Auth::user()
    		));
    }
}

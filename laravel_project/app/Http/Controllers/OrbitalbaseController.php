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

    public function orbitalbaseUpgradeOrCreate(Request $request){

    	if($request->input('shipyard_upgrating')){
    		return $this->UpgradeShipyard($request);
    	}elseif ($request->input('shipyard_create')) {
    		return $this->CreateShips($request);
    	}

    }

    public function UpgradeShipyard(Request $request){
    	
    	return view('test',array('test' => 'Upgrade Shipyard'));

    }

 	public function CreateShips($request){

 	}


}

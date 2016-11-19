<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BattlestationController extends Controller
{
    public function battlestationIndex($user_id){
    	echo "User ID : ".$user_id;
    }
}

<?php

namespace App\Http\Controllers;

use Auth;
use DB;
use App\User;
use Illuminate\Http\Request;

class RadarController extends Controller
{
    public function radarIndex(){
    	return view('radar',array(
    			'user' => Auth::user(),
    			'allUsers' => DB::table('users')
    				->where('users.id', '!=' , Auth::id())
    				->join('homeplanets','users.id','=','homeplanets.user_id')
    				->select('users.id' , 'users.name' , 'users.nickname' , 'users.avatar' , 'users.level',
    					'users.battles_won' , 'users.battles_lost', 'homeplanets.name as homeplanet_name' ,
    					'homeplanets.x' , 'homeplanets.y' , 'homeplanets.galaxy')
    				->paginate(5)
    		));
    }
}

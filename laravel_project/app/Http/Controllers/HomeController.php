<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $currentUser = Auth::user();
        date_default_timezone_set('Europe/Bucharest');

        $battleInProgress = $currentUser->battles
        ->where('battle_time','!=' ,null)
        ->where('defender', '=' , $currentUser->id)
        ->first() ? true : false;

        if($battleInProgress == true){
            $timeToEngage = $currentUser->battles
            ->where('battle_time','!=' ,null)
            ->where('defender', '=' , $currentUser->id)
            ->first();

            
            $time = $timeToEngage->battle_time;
            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('Y');
            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('m');
            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('d');
            $hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H');
            $minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('i');
            $second = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('s');



            return view('home',array(
                'user' => $currentUser ,
                'battleInProgress' => $battleInProgress,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'hour' => $hour,
                'minute' => $minute,
                'second' => $second
                ));

            }else{
                return view('home',array(
                'user' => $currentUser ,
                'battleInProgress' => $battleInProgress,
                ));
            }
        
    }
}

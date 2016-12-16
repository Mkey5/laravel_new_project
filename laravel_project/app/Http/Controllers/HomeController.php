<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
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

        $defenceInProgress = $currentUser->battles
        ->where('battle_time','!=' , '0001-01-01 00:00:00')
        ->where('defender', '=' , $currentUser->id)
        ->first() ? true : false;

        $attackInProgress = $currentUser->battles
        ->where('battle_time','!=' , '0001-01-01 00:00:00')
        ->where('attacker', '=' , $currentUser->id)
        ->first() ? true : false;

        $returnInProgress = $currentUser->battles
        ->where('return_time','!=' , '0001-01-01 00:00:00')
        ->where('battle_time','=' , '0001-01-01 00:00:00')
        ->where('attacker', '=' , $currentUser->id)
        ->first() ? true : false;


        if($defenceInProgress == true && $attackInProgress == true || 
            $defenceInProgress == true && $returnInProgress == true){

            $battle = $currentUser->battles
            ->where('battle_time','!=' ,null)
            ->where('defender', '=' , $currentUser->id)
            ->first();

            
            $attacker = User::where('id','=',$battle->attacker)->first();
            $attacker_nick = $attacker->nickname;

            $time = $battle->battle_time;
            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('Y');
            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('m');
            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('d');
            $hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H');
            $minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('i');
            $second = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('s');


            if($defenceInProgress == true && $returnInProgress == true){
                $battle_attack = $currentUser->battles
                ->where('winner' , '=' , $currentUser->id)
                ->where('battle_time','=' , '0001-01-01 00:00:00')
                ->where('return_time','!=' , '0001-01-01 00:00:00')
                ->where('attacker', '=' , $currentUser->id)
                ->first();


                $time_return = $battle->return_time;
                $year_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('Y');
                $month_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('m');
                $day_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('d');
                $hour_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('H');
                $minute_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('i');
                $second_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('s');


                return view('home',array(
                    'user' => $currentUser ,
                    'defenceInProgress' => $defenceInProgress,
                    'attackInProgress' => $attackInProgress,
                    'year' => $year,
                    'month' => $month,
                    'day' => $day,
                    'hour' => $hour,
                    'minute' => $minute,
                    'second' => $second,
                    'attacker_nick' => $attacker_nick,
                    'year_return' => $year_return,
                    'month_return' => $month_return,
                    'day_return' => $day_return,
                    'hour_return' => $hour_return,
                    'minute_return' => $minute_return,
                    'second_return' => $second_return
                    ));                
            }

            $battle_attack = $currentUser->battles
            ->where('battle_time','!=' , '0001-01-01 00:00:00')
            ->where('attacker', '=' , $currentUser->id)
            ->first();

            
            $time_attack = $battle_attack->battle_time;
            $year_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('Y');
            $month_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('m');
            $day_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('d');
            $hour_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('H');
            $minute_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('i');
            $second_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('s');


            $time_return = $battle->return_time;
            $year_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('Y');
            $month_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('m');
            $day_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('d');
            $hour_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('H');
            $minute_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('i');
            $second_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('s');


            return view('home',array(
                'user' => $currentUser ,
                'defenceInProgress' => $defenceInProgress,
                'attackInProgress' => $attackInProgress,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'hour' => $hour,
                'minute' => $minute,
                'second' => $second,
                'year_attack' => $year_attack,
                'month_attack' => $month_attack,
                'day_attack' => $day_attack,
                'hour_attack' => $hour_attack,
                'minute_attack' => $minute_attack,
                'second_attack' => $second_attack,
                'attacker_nick' => $attacker_nick,
                'year_return' => $year_return,
                'month_return' => $month_return,
                'day_return' => $day_return,
                'hour_return' => $hour_return,
                'minute_return' => $minute_return,
                'second_return' => $second_return
                ));


        // }elseif ($defenceInProgress == true && $returnInProgress == true) {


        }elseif ($defenceInProgress == true) {
            $battle = $currentUser->battles
            ->where('battle_time','!=' , '0001-01-01 00:00:00')
            ->where('defender', '=' , $currentUser->id)
            ->first();

            
            $attacker = User::where('id','=',$battle->attacker)->first();
            $attacker_nick = $attacker->nickname;

            $time = $battle->battle_time;
            $year = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('Y');
            $month = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('m');
            $day = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('d');
            $hour = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('H');
            $minute = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('i');
            $second = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time)->format('s');


            return view('home',array(
                'user' => $currentUser ,
                'defenceInProgress' => $defenceInProgress,
                'attackInProgress' => $attackInProgress,
                'year' => $year,
                'month' => $month,
                'day' => $day,
                'hour' => $hour,
                'minute' => $minute,
                'second' => $second,
                'attacker_nick' => $attacker_nick
                ));

        }elseif($attackInProgress == true || $returnInProgress == true){
            $battle = $currentUser->battles
            ->where('battle_time','!=' , '0001-01-01 00:00:00')
            ->where('attacker', '=' , $currentUser->id)
            ->first();

           if($returnInProgress == true){
                $battle = $currentUser->battles
                ->where('battle_time','=' , '0001-01-01 00:00:00')
                ->where('return_time','!=' , '0001-01-01 00:00:00')
                ->where('attacker', '=' , $currentUser->id)
                ->first();

                $time_return = $battle->return_time;
                $year_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('Y');
                $month_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('m');
                $day_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('d');
                $hour_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('H');
                $minute_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('i');
                $second_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('s');



                return view('home',array(
                    'user' => $currentUser ,
                    'defenceInProgress' => $defenceInProgress,
                    'attackInProgress' => $attackInProgress,
                    'year_return' => $year_return,
                    'month_return' => $month_return,
                    'day_return' => $day_return,
                    'hour_return' => $hour_return,
                    'minute_return' => $minute_return,
                    'second_return' => $second_return
                    ));

            }

            $time_attack = $battle->battle_time;
            $year_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('Y');
            $month_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('m');
            $day_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('d');
            $hour_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('H');
            $minute_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('i');
            $second_attack = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_attack)->format('s');

            $time_return = $battle->return_time;
            $year_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('Y');
            $month_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('m');
            $day_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('d');
            $hour_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('H');
            $minute_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('i');
            $second_return = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $time_return)->format('s');



            return view('home',array(
                'user' => $currentUser ,
                'defenceInProgress' => $defenceInProgress,
                'attackInProgress' => $attackInProgress,
                'year_attack' => $year_attack,
                'month_attack' => $month_attack,
                'day_attack' => $day_attack,
                'hour_attack' => $hour_attack,
                'minute_attack' => $minute_attack,
                'second_attack' => $second_attack,
                'year_return' => $year_return,
                'month_return' => $month_return,
                'day_return' => $day_return,
                'hour_return' => $hour_return,
                'minute_return' => $minute_return,
                'second_return' => $second_return
                ));

        }

            return view('home',array(
            'user' => $currentUser ,
            'defenceInProgress' => $defenceInProgress,
            'attackInProgress' => $attackInProgress
            ));
            
        
    }
}

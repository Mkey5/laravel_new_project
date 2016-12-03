<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use DB;

class UpdateBattlelog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:battlelog';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for battles and if there are battles in progress - updating battle log';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $allBattlesInProgress = DB::table('battles')
            ->where('return_time','!=',null)
            ->get();
           

        foreach ($allBattlesInProgress as $battle) {

            $attacker = DB::table('users')
                ->where('users.id','=',$battle->attacker)
                ->join('orbitalbases','users.id' , '=' , 'orbitalbases.user_id')
                ->join('fleets' , 'users.id' , '=' , 'fleets.user_id')
                ->first();     

            $defender = DB::table('users')
                ->where('users.id','=',$battle->defender)
                ->join('orbitalbases','users.id' , '=' , 'orbitalbases.user_id')
                ->join('fleets' , 'users.id' , '=' , 'fleets.user_id')
                ->first();
             
            // updating and calculating battle 
            if($battle->battle_time != null){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $planetBuildings->gold_upgrating_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){
                    // calculatin defences of defender
                    $defender_attack = 0;
                    $defender_defence = 0;

                    $defender_attack += $defender->frigates * \App\Frigate::$attack_def;
                    $defender_defence += $defender->frigates * \App\Frigate::$defence_def;

                    $defender_attack += $defender->corvettes * \App\Corvette::$attack_def;
                    $defender_defence += $defender->corvettes * \App\Corvette::$defence_def;

                    $defender_attack += $defender->destroyers * \App\Destroyer::$attack_def;
                    $defender_defence += $defender->destroyers * \App\Destroyer::$defence_def;

                    $defender_attack += $defender->assaultcarriers * \App\Assaultcarrier::$attack_def;
                    $defender_defence += $defender->assaultcarriers * \App\Assaultcarrier::$defence_def;

                    if($defender->state == 'orbiting'){
                        $defender_attack += $defender->attack;
                        $defender_defence += $defender->defence;
                    }

                    //check if attacker won
                    if($attaker->){

                    }

                }
            }

            // if attacker won - updating and calculating battle
            if($battle->battle_time == null && $battle->return_time != null ){

            }

            
        }
    }
}

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
           
        public function updateFleetHomeBattleTable($percentShipLost , $percentResources , $battle){
            //TODO
        }

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
                $timeDB = $battle->battle_time;
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


                    
                    //Calc left ships in fleet and/or defender orbiting/fleet ships
                    //update gold , metal ,energy to battle table
                    //battle table - update $battle->battle_time == null

                    //check if attacker won
                    if($attaker->attack > $defender->defence){
                        //won
                        $battleScore = $attacker->attack - $defender->defence;
                        

                        if($battleScore >= 300){
                            //total victory


                            // \App\Homeplanet::where('user_id','=',$attacker->id)->update([
                            //          'frigate' => $FleetFrigates,
                            //          'corvette' => $FleetCorvettes,
                            //          'destroyer' => $FleetDestroyers,
                            //          'assault_carrier' => $FleetAssault_carriers,
                            //          'attack' => $FleetAttack,
                            //          'defence' => $FleetDefence ,
                            //          'state' => 'ready'
                            //         ]);

                            // \App\Battle::where('id' , '=' , $battle->id)->update([]);

                            // \App\Fleet::where('user_id','=',$attacker->id)->update([
                            //          'frigate' => $FleetFrigates,
                            //          'corvette' => $FleetCorvettes,
                            //          'destroyer' => $FleetDestroyers,
                            //          'assault_carrier' => $FleetAssault_carriers,
                            //          'attack' => $FleetAttack,
                            //          'defence' => $FleetDefence ,
                            //          'state' => 'ready'
                            //         ]);

                            // \App\Orbitalbase::where('user_id','=',$currentUser->id)->update([
                            //          'frigates' => 0 ,
                            //          'corvettes' => 0 ,
                            //          'destroyers' => 0 ,
                            //          'assaultcarriers' => 0
                            //         ]);


                        }elseif($battleScore >= 200){

                        }elseif($battleScore >= 100){

                        }elseif($battleScore >= 50){

                        }else{
                            
                        }

                        echo round(9.5, 0, PHP_ROUND_HALF_DOWN); // 9
                        $x = rand(0,39)
                    }elseif($attaker->attack < $defender->defence){
                        //lost
                    }elseif ($attaker->attack == $defender->defence) {
                        //==
                    }

                }
            }

            // if attacker won - updating and calculating battle 
            if($battle->battle_time == null && $battle->return_time != null ){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $battle->return_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){
                    //update gold , metal ,energy to attacker homeplanet
                    //left ships from fleet - update to orbitalbase , state == orbiting
                    //battle table - update $battle->return_time == null
                }
            }

            
        }
    }
}

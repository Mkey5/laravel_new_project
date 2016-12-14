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


    public function calcShips($ships , $percent , $shipType){
        
        if($ships == 0){
            return 0;
        }elseif( ($ships == 1) && 
            ($percent >= 0.50) && 
            ($percent <= 0.70) && 
            ($shipType == "D" || $shipType == "A") ){  // some benefit for destroyers and A.carriers

            return 1;
        }else{
            $lostShips = round(($ships * $percent), 0, PHP_ROUND_HALF_DOWN);
            $ships -= $lostShips;
            return $ships;
        }

    }

    public function calcBattle($percent , $attacker , $defender , $battle){

        $attacker_frigates = $attacker->frigate;
        $attacker_corvettes = $attacker->corvette;
        $attacker_destroyers = $attacker->destroyer;
        $attacker_assaultcarriers = $attacker->assault_carrier;


        $attacker_frigates_left = $this->calcShips($attacker_frigates ,$percent , "F");

        
        $attacker_corvettes_left = $this->calcShips($attacker_corvettes ,$percent , "C");
        
        $attacker_destroyers_left = $this->calcShips($attacker_destroyers ,$percent , "D");
        
        $attacker_assaultcarriers_left = $this->calcShips($attacker_assaultcarriers ,$percent , "A");
        
        // if the % is very big , but the fleet is made only of single ships of every type, so that 
        // the fleet won't have 0 ships in it. After all the attacker has won ;) 

        if( $attacker_frigates <= 1 && $attacker_corvettes <= 1 && $attacker_destroyers <= 1 && $attacker_assaultcarriers <= 1){

            if($attacker_frigates_left == 0 && $attacker_corvettes_left == 0 && $attacker_destroyers_left == 0 && $attacker_assaultcarriers_left == 0){

                // so after calculation the fleet is empty (we can't leave it like that , so we will 
                // revive one ship , the biggest of the fleet)
                if($attacker_assaultcarriers == 1){

                    $attacker_assaultcarriers_left = 1;

                }elseif($attacker_destroyers == 1){

                    $attacker_destroyers_left = 1;

                }elseif($attacker_corvettes == 1){

                    $attacker_corvettes_left = 1;

                }elseif($attacker_frigates == 1){

                    $attacker_frigates_left = 1;
                }

            }

        }

        \App\Fleet::where('user_id','=',$attacker->id)->update([
                 'frigate' => $attacker_frigates_left,
                 'corvette' => $attacker_corvettes_left,
                 'destroyer' => $attacker_destroyers_left,
                 'assault_carrier' => $attacker_assaultcarriers_left
                ]);


        \App\Orbitalbase::where('user_id','=',$defender->id)->update([
                 'frigates' => 0 ,
                 'corvettes' => 0 ,
                 'destroyers' => 0 ,
                 'assaultcarriers' => 0
                ]);


        $percentResources = 1 - $percent;

        $defender_homeplanet = DB::table('homeplanets')
                ->where('user_id','=',$defender->id)
                ->first();

        $goldWon = round(($defender_homeplanet->gold * $percentResources), 0, PHP_ROUND_HALF_DOWN);
        $metalWon = round(($defender_homeplanet->metal * $percentResources), 0, PHP_ROUND_HALF_DOWN);
        $energyWon = round(($defender_homeplanet->energy * $percentResources), 0, PHP_ROUND_HALF_DOWN);
          
        $goldLeft = $defender_homeplanet->gold - $goldWon;
        $metalLeft = $defender_homeplanet->metal - $metalWon;
        $energyLeft = $defender_homeplanet->energy - $energyWon;

        \App\Homeplanet::where('user_id','=',$defender->id)->update([
                 'gold' => $goldLeft ,
                 'metal' => $metalLeft,
                 'energy' => $energyLeft
                ]);
   

        \App\Battle::where('id' , '=' , $battle->id)->update([
            'winner' => $attacker->id,
            'loser' => $defender->id,
            'gold' => $goldWon ,
            'metal' => $metalWon ,
            'energy' => $energyWon ,
            'ships_losses' => $percent ,
            'battle_time' => null
            ]);


        return true;
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


                    
                    //Calc left ships in fleet and/or defender orbiting/fleet ships
                    //update gold , metal ,energy to battle table
                    //battle table - update $battle->battle_time == null

                    //check if attacker won
                    if($attacker->attack > $defender_defence){
                        //won
                        $battleScore = $attacker->attack - $defender->defence;

                        if($battleScore >= 800){
                            //total victory
                            $this->calcBattle(0 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 700){

                            $this->calcBattle(0.1 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 600){

                            $this->calcBattle(0.1 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 500){

                            $this->calcBattle(0.2 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 400){

                            $this->calcBattle(0.3 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 300){

                            $this->calcBattle(0.4 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 200){

                            $this->calcBattle(0.5 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 100){

                            $this->calcBattle(0.6 , $attacker , $defender , $battle);

                        }elseif($battleScore >= 50){

                            $this->calcBattle(0.7, $attacker , $defender , $battle);

                        }else{
                           
                            $this->calcBattle(0.8 , $attacker , $defender , $battle);

                        }

                        
                    }elseif($attacker->attack < $defender_defence){
                        //lost

                        \App\Fleet::where('user_id','=',$attacker->id)->update([
                                 'frigate' => 0,
                                 'corvette' => 0,
                                 'destroyer' => 0,
                                 'assault_carrier' => 0,
                                 'attack' => 0 ,
                                 'defence' => 0 ,
                                 'state' => "orbiting"
                                ]);


                        $defender_frigates = $defender->frigates;
                        $defender_corvettes = $defender->corvettes;
                        $defender_destroyers = $defender->destroyers;
                        $defender_assaultcarriers = $defender->assaultcarriers;


                        $battleScore = abs($attacker->attack - $defender->defence);

                        if($battleScore >= 800){
                            //total victory
                            $percentDefenderShips = 0;

                        }elseif($battleScore >= 700){

                            $percentDefenderShips = 0.1;

                        }elseif($battleScore >= 600){

                          $percentDefenderShips = 0.1;  

                        }elseif($battleScore >= 500){

                          $percentDefenderShips = 0.2;  

                        }elseif($battleScore >= 400){

                           $percentDefenderShips = 0.3; 

                        }elseif($battleScore >= 300){

                            $percentDefenderShips = 0.4;

                        }elseif($battleScore >= 200){

                            $percentDefenderShips = 0.5;

                        }elseif($battleScore >= 100){

                            $percentDefenderShips = 0.6;

                        }elseif($battleScore >= 50){

                           $percentDefenderShips = 0.7;

                        }else{
                           
                            $percentDefenderShips = 0.8;

                        }


                        \App\Battle::where('id' , '=' , $battle->id)->update([
                            'winner' => $defender->id,
                            'loser' => $attacker->id,
                            'gold' => 0 ,
                            'metal' => 0 ,
                            'energy' => 0 ,
                            'ships_losses' => $percentDefenderShips ,
                            'battle_time' => null,
                            'return_time' => null
                            ]);


                        $defender_frigates_left = $this->calcShips($defender_frigates ,$percentDefenderShips , "F");  
                        
                        $defender_corvettes_left = $this->calcShips($defender_corvettes ,$percentDefenderShips , "C");
                        
                        $defender_destroyers_left = $this->calcShips($defender_destroyers ,$percentDefenderShips , "D");
                        
                        $defender_assaultcarriers_left = $this->calcShips($defender_assaultcarriers ,$percentDefenderShips , "A");
                        
                        // if the % is very big , but the docks have only single ships of every type, so that 
                        // the docks won't have 0 ships in it. After all the defender has won ;) 

                        if( $defender_frigates <= 1 && $defender_corvettes <= 1 && $defender_destroyers <= 1 && $defender_assaultcarriers <= 1){

                            if($defender_frigates_left == 0 && $defender_corvettes_left == 0 && $defender_destroyers_left == 0 && $defender_assaultcarriers_left == 0){

                                // so after calculation the docks are empty (we can't leave it like that , so we will 
                                // revive one ship , the biggest in the docks)
                                if($defender_assaultcarriers == 1){

                                    $defender_assaultcarriers_left = 1;

                                }elseif($defender_destroyers == 1){

                                    $defender_destroyers_left = 1;

                                }elseif($defender_corvettes == 1){

                                    $defender_corvettes_left = 1;

                                }elseif($defender_frigates == 1){

                                    $defender_frigates_left = 1;
                                }

                            }

                        }

                        \App\Orbitalbase::where('user_id','=',$defender->id)->update([
                             'frigates' => $defender_frigates_left ,
                             'corvettes' => $defender_corvettes_left ,
                             'destroyers' => $defender_destroyers_left ,
                             'assaultcarriers' => $defender_assaultcarriers_left
                            ]);

                    }elseif ($attacker->attack == $defender_defence) {
                        //==

                        \App\Fleet::where('user_id','=',$attacker->id)->update([
                                 'frigate' => 0,
                                 'corvette' => 0,
                                 'destroyer' => 0,
                                 'assault_carrier' => 0,
                                 'attack' => 0 ,
                                 'defence' => 0 ,
                                 'state' => "orbiting"
                                ]);


                        \App\Orbitalbase::where('user_id','=',$defender->id)->update([
                                 'frigates' => 0 ,
                                 'corvettes' => 0 ,
                                 'destroyers' => 0 ,
                                 'assaultcarriers' => 0
                                ]);

                 

                        \App\Battle::where('id' , '=' , $battle->id)->update([
                            'winner' => $defender->id,
                            'loser' => $attacker->id,
                            'gold' => 0 ,
                            'metal' => 0 ,
                            'energy' => 0 ,
                            'ships_losses' => 1 ,// 100% ships destroyed
                            'battle_time' => null,
                            'return_time' => null
                            ]);
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

                    \App\Orbitalbase::where('user_id','=',$attacker->id)->update([
                             'frigates' => $attacker->frigate ,
                             'corvettes' => $attacker->corvette ,
                             'destroyers' => $attacker->destroyer ,
                             'assaultcarriers' => $attacker->assault_carrier
                            ]);

                    \App\Fleet::where('user_id','=',$attacker->id)->update([
                             'frigate' => 0 ,
                             'corvette' => 0 ,
                             'destroyer' => 0 ,
                             'assault_carrier' => 0 ,
                             'attack' => 0 ,
                             'defence' => 0 ,
                             'state' => "orbiting"
                            ]);

                    
                    $homeplanetDefender = DB::table('homeplanets')
                        ->where('user_id','=',$attacker->id)
                        ->first();


                    $goldNew = $homeplanetDefender->gold + $battle->gold;
                    $metalNew = $homeplanetDefender->metal + $battle->metal;
                    $energyNew = $homeplanetDefender->energy + $battle->energy;

                    \App\Homeplanet::where('user_id','=',$attacker->id)->update([
                            'gold' => $goldNew ,
                            'metal' => $metalNew,
                            'energy' => $energyNew
                            ]);
               

                    \App\Battle::where('id' , '=' , $battle->id)->update([
                            'return_time' => null
                            ]);

                }
            }

        }    
        
    }
}

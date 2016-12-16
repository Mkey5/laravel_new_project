<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateUpgratingOfBuildings extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:upgrating';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check for buildings that must be upgrated and updated in the DB';

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
        // Home Planet Buildings

        $allPlanetsBuildings = DB::table('homeplanets')
            ->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
            ->join('powerplants','homeplanets.id' , '=','powerplants.homeplanet_id')
            ->join('metalmines','homeplanets.id' , '=','metalmines.homeplanet_id')
            ->select(
                'homeplanets.id',
                'goldmines.income as gold_income',
                'goldmines.cost_gold as gold_cost_gold',
                'goldmines.cost_metal as gold_cost_metal',
                'goldmines.cost_energy as gold_cost_energy',
                'goldmines.level as gold_level',
                'goldmines.upgrating_time as gold_upgrating_time',

                'metalmines.income as metal_income',
                'metalmines.cost_gold as metal_cost_gold',
                'metalmines.cost_metal as metal_cost_metal',
                'metalmines.cost_energy as metal_cost_energy',
                'metalmines.level as metal_level',
                'metalmines.upgrating_time as metal_upgrating_time',

                'powerplants.income as energy_income',
                'powerplants.cost_gold as energy_cost_gold',
                'powerplants.cost_metal as energy_cost_metal',
                'powerplants.cost_energy as energy_cost_energy',
                'powerplants.level as energy_level',
                'powerplants.upgrating_time as energy_upgrating_time'
                )
            ->get();

            foreach ($allPlanetsBuildings as $planetBuildings) {

                if($planetBuildings->gold_upgrating_time != '0001-01-01 00:00:00'){
                    date_default_timezone_set('Europe/Bucharest');
                    $timeDB = $planetBuildings->gold_upgrating_time;
                    $timeNow = \Carbon\Carbon::now();

                    if($timeNow > $timeDB){

                        $newLevel = $planetBuildings->gold_level + 1;
                        $newIncome = $planetBuildings->gold_income * $newLevel;
                        $newCostGold = $planetBuildings->gold_cost_gold * $newLevel;
                        $newCostMetal = $planetBuildings->gold_cost_metal * $newLevel;
                        $newCostEnergy = $planetBuildings->gold_cost_energy * $newLevel;
                        
                        \App\Goldmine::where('id', '=' , $planetBuildings->id)->update([
                            'income' => $newIncome ,
                            'level' => $newLevel,
                            'cost_gold' => $newCostGold,
                            'cost_metal' => $newCostMetal,
                            'cost_energy' => $newCostEnergy,
                            'upgrating_time' => '0001-01-01 00:00:00'
                            ]);


                    }
                }

                if($planetBuildings->metal_upgrating_time != '0001-01-01 00:00:00'){
                    date_default_timezone_set('Europe/Bucharest');
                    $timeDB = $planetBuildings->metal_upgrating_time;
                    $timeNow = \Carbon\Carbon::now();

                    if($timeNow > $timeDB){

                        $newLevel = $planetBuildings->metal_level + 1;
                        $newIncome = $planetBuildings->metal_income * $newLevel;
                        $newCostGold = $planetBuildings->metal_cost_gold * $newLevel;
                        $newCostMetal = $planetBuildings->metal_cost_metal * $newLevel;
                        $newCostEnergy = $planetBuildings->metal_cost_energy * $newLevel;
                        
                        \App\Metalmine::where('id', '=' , $planetBuildings->id)->update([
                            'income' => $newIncome ,
                            'level' => $newLevel,
                            'cost_gold' => $newCostGold,
                            'cost_metal' => $newCostMetal,
                            'cost_energy' => $newCostEnergy,
                            'upgrating_time' => '0001-01-01 00:00:00'
                            ]);
                    }


            }

            if($planetBuildings->energy_upgrating_time != '0001-01-01 00:00:00'){
                    date_default_timezone_set('Europe/Bucharest');
                    $timeDB = $planetBuildings->energy_upgrating_time;
                    $timeNow = \Carbon\Carbon::now();

                    if($timeNow > $timeDB){

                        $newLevel = $planetBuildings->energy_level + 1;
                        $newIncome = $planetBuildings->energy_income * $newLevel;
                        $newCostGold = $planetBuildings->energy_cost_gold * $newLevel;
                        $newCostMetal = $planetBuildings->energy_cost_metal * $newLevel;
                        $newCostEnergy = $planetBuildings->energy_cost_energy * $newLevel;
                        
                        \App\Powerplant::where('id', '=' , $planetBuildings->id)->update([
                            'income' => $newIncome ,
                            'level' => $newLevel,
                            'cost_gold' => $newCostGold,
                            'cost_metal' => $newCostMetal,
                            'cost_energy' => $newCostEnergy,
                            'upgrating_time' => '0001-01-01 00:00:00'
                            ]);
                    }

            }


        }

        // Orbital Base Buildings

        $allShipyards = DB::table('shipyards')->get();

        foreach ($allShipyards as $shipyard) {
            if($shipyard->upgrating_time != '0001-01-01 00:00:00'){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $shipyard->upgrating_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){
                    $newLevel = $shipyard->level + 1;
                    $newCostGold = $shipyard->cost_gold * $newLevel;
                    $newCostMetal = $shipyard->cost_metal * $newLevel;
                    $newCostEnergy = $shipyard->cost_energy * $newLevel;

                    \App\Shipyard::where('id' , '=' , $shipyard->id)->update([
                        'level' => $newLevel ,
                        'cost_gold' => $newCostGold ,
                        'cost_metal' => $newCostMetal ,
                        'cost_energy' => $newCostEnergy ,
                        'upgrating_time' => '0001-01-01 00:00:00'

                        ]);
                }
            }
        }



    }
}

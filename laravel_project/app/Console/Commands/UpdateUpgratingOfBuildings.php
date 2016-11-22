<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

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
        
        $allPlanetsBuildings = Db::table('homeplanets')
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
                # code...
            }

         //    foreach ($allhomeplanets as $homeplanet) {
         //        $homeplanet->gold += ($homeplanet->gold_income) * $homeplanet->goldmines_level;
         //        $homeplanet->metal += ($homeplanet->metal_income) * $homeplanet->metalmines_level;
         //        $homeplanet->energy += ($homeplanet->energy_income) * $homeplanet->energy_level;

         //        \App\Homeplanet::where('id',$homeplanet->id)->update([
         //            'gold' => $homeplanet->gold,
         //            'metal' => $homeplanet->metal,
         //            'energy' => $homeplanet->energy
         //            ]);
         //    }


    // this is for the end
            App\Goldmine::where('homeplanet_id','=',Auth::id())->update([
                'upgrating_time' => null
                ]);
            App\Metalmine::where('homeplanet_id','=',Auth::id())->update([
                'upgrating_time' => null
                ]);
            App\Powerplant::where('homeplanet_id','=',Auth::id())->update([
                'upgrating_time' => null
                ]);

    }
}

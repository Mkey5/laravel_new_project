<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateIncome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:income';
    

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating resources';

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
        
            $allhomeplanets = DB::table('homeplanets')
                ->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
                ->join('powerplants','homeplanets.id' , '=','powerplants.homeplanet_id')
                ->join('metalmines','homeplanets.id' , '=','metalmines.homeplanet_id')
                ->select('homeplanets.id','homeplanets.gold','homeplanets.metal','homeplanets.energy','goldmines.income as gold_income','metalmines.income as metal_income','powerplants.income as energy_income','goldmines.level as goldmines_level','metalmines.level as metalmines_level','powerplants.level as energy_level')
                ->get();


            foreach ($allhomeplanets as $homeplanet) {
                $homeplanet->gold += ($homeplanet->gold_income) * $homeplanet->goldmines_level;
                $homeplanet->metal += ($homeplanet->metal_income) * $homeplanet->metalmines_level;
                $homeplanet->energy += ($homeplanet->energy_income) * $homeplanet->energy_level;

                \App\Homeplanet::where('id',$homeplanet->id)->update([
                    'gold' => $homeplanet->gold,
                    'metal' => $homeplanet->metal,
                    'energy' => $homeplanet->energy
                    ]);
            }



    
    }
}

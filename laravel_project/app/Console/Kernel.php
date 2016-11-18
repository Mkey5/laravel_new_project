<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')
        //          ->hourly();

        $schedule->call(function(){
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

                App\Homeplanet::where('id',$homeplanet->id)->update([
                    'gold' => $homeplanet->gold,
                    'metal' => $homeplanet->metal,
                    'energy' => $homeplanet->energy
                    ]);
            }

        })->cron('2 * * * * *'); // every 2 minutes will add income to homeplanet resources
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}

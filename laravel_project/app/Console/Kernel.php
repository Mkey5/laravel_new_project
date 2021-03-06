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
        // Commands\UpdateIncome::class
        \App\Console\Commands\UpdateIncome::class,
        \App\Console\Commands\UpdateUpgratingOfBuildings::class,
        \App\Console\Commands\UpdateBuildingShips::class,
        \App\Console\Commands\UpdateBattlelog::class,
        \App\Console\Commands\UpdateLevelUser::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        
        $schedule->command('check:upgrating')->everyMinute();
        $schedule->command('check:ships')->everyMinute();
        $schedule->command('check:battlelog')->everyMinute();
        $schedule->command('check:userlevel')->hourly();
        $schedule->command('update:income')->cron('*/2 * * * * *'); // every two minutes

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

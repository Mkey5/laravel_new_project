<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;


class UpdateBuildingShips extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:ships';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Updating created ships';

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
        $allShipyards = DB::table('shipyards')->get();

        foreach ($allShipyards as $shipyard) {
            if($shipyard->frigate_time != null){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $shipyard->frigate_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){

                    $allHisFrigates = DB::table('frigates')
                        ->where([
                            ['orbitalbase_id' , '=' , $shipyard->orbitalbase_id],
                            ['state' , '=' , 'docked'],
                            ])->get();


                    $shipNumberToAdd = 0;

                    foreach ($allHisFrigates as $frigate) {
                        $shipNumberToAdd++;
                    }

                    \App\Orbitalbase::where('id' , '=' , $shipyard->orbitalbase_id)->update([
                        'frigates' => $shipNumberToAdd
                        ]);

                    \App\Shipyard::where('id' , '=' , $shipyard->id)->update([
                        'frigate_time' => null
                        ]);

                }
            }

            if($shipyard->corvette_time != null){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $shipyard->corvette_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){

                    $allHisCorvettes = DB::table('corvettes')
                        ->where([
                            ['orbitalbase_id' , '=' , $shipyard->orbitalbase_id],
                            ['state' , '=' , 'docked'],
                            ])->get();


                    $shipNumberToAdd = 0;

                    foreach ($allHisCorvettes as $corvette) {
                        $shipNumberToAdd++;
                    }

                    \App\Orbitalbase::where('id' , '=' , $shipyard->orbitalbase_id)->update([
                        'corvettes' => $shipNumberToAdd
                        ]);

                    \App\Shipyard::where('id' , '=' , $shipyard->id)->update([
                        'corvette_time' => null
                        ]);

                }
            }

            if($shipyard->destroyer_time != null){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $shipyard->destroyer_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){

                    $allHisDestroyers = DB::table('destroyers')
                        ->where([
                            ['orbitalbase_id' , '=' , $shipyard->orbitalbase_id],
                            ['state' , '=' , 'docked'],
                            ])->get();


                    $shipNumberToAdd = 0;

                    foreach ($allHisDestroyers as $destroyer) {
                        $shipNumberToAdd++;
                    }

                    \App\Orbitalbase::where('id' , '=' , $shipyard->orbitalbase_id)->update([
                        'destroyers' => $shipNumberToAdd
                        ]);

                    \App\Shipyard::where('id' , '=' , $shipyard->id)->update([
                        'destroyer_time' => null
                        ]);

                }
            }

            if($shipyard->assaultcarrier_time != null){
                date_default_timezone_set('Europe/Bucharest');
                $timeDB = $shipyard->assaultcarrier_time;
                $timeNow = \Carbon\Carbon::now();

                if($timeNow > $timeDB){

                    $allHisAssaultCarriors = DB::table('assaultcarriers')
                        ->where([
                            ['orbitalbase_id' , '=' , $shipyard->orbitalbase_id],
                            ['state' , '=' , 'docked'],
                            ])->get();


                    $shipNumberToAdd = 0;

                    foreach ($allHisAssaultCarriors as $assaultcarrier) {
                        $shipNumberToAdd++;
                    }

                    \App\Orbitalbase::where('id' , '=' , $shipyard->orbitalbase_id)->update([
                        'assaultcarriers' => $shipNumberToAdd
                        ]);

                    \App\Shipyard::where('id' , '=' , $shipyard->id)->update([
                        'assaultcarrier_time' => null
                        ]);

                }
            }




        }
    }
}

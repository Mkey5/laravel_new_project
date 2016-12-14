<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class UpdateLevelUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'check:userlevel';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Checks if the level of development of the user is the same as his buildings';

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
         $allUsers = DB::table('users')
                ->join('goldmines','users.id','=','goldmines.homeplanet_id')
                ->join('powerplants','users.id' , '=','powerplants.homeplanet_id')
                ->join('metalmines','users.id' , '=','metalmines.homeplanet_id')
                ->join('shipyards','users.id', '=' , 'shipyards.orbitalbase_id')
                ->select('users.id','users.level as user_level','goldmines.level as goldmine_level','metalmines.level as metalmine_level','powerplants.level as energy_level')
                ->get();



            foreach ($allUsers as $user) {
                $check = true;
                $user_level = $user->user_level;
                $goldmine_level = $user->goldmine_level;
                $metalmine_level = $user->metalmine_level;
                $energy_level = $user->energy_level;

                while ($check) { 
                    if($goldmine_level > $user_level && $metalmine_level > $user_level && $energy_level > $user_level){
                        $user_level++;
                    }else{
                        $check = false;
                    }
                }

                \App\User::where('id',$user->id)->update([
                    'level' => $user_level
                    ]);

            }

    }
}

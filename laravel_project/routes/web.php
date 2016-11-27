<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');


// with this Route Group we can protect everything that will not be accessed by users who are not admin
Route::group(['middleware'=>['admin']],function(){
    Route::get('admin', function(){
        echo "You're the admin!";
    });
});

Route::group(['middleware' => ['auth']],function(){ //checks if you're loged in 
	Route::get('/profile','UserController@profile');
	Route::post('/profile','UserController@update_avatar');
	Route::get('/radar' , 'RadarController@radarIndex');
	Route::get('/battlestation/{user_id}','BattlestationController@battlestationIndex');

	Route::get('homeplanet','HomeplanetController@homeplanetIndex');
	Route::post('homeplanet' , 'HomeplanetController@homeplanetUpgrade');

	Route::get('orbitalbase','OrbitalbaseController@orbitalbaseIndex');
	Route::post('orbitalbase','OrbitalbaseController@orbitalbaseUpgradeOrCreate');
});

Route::group(['middleware' => ['registersteptwo']],function(){
	Route::get('/register-step-2','RegistersteptwoController@stepTwoIndex');
	Route::post('/register-step-2','RegistersteptwoController@createDefaultGameClasses');
});




// TODO-MAK real 2D load map

// TODO-MAK battles reports many to many relationship 





Route::get('/test_3' , function(){
	// $curentUser = Auth::user();
	// $timeInDB = $curentUser->homeplanet->goldmine->upgrating_time;

	// date_default_timezone_set('Europe/Bucharest');
	// $timeNow = Carbon\Carbon::now();
	// echo "<br><br>Time saved in DB : " .$timeInDB ." Time now : " .$timeNow;

	// if($timeNow > $timeInDB){
	// 	echo "<br>" .$timeInDB. " is in the past";
	// }else{
	// 	echo "<br>" .$timeInDB . " is in the furure";
	// }


	if(true){
		echo "Basi majkata 1";
	}

	if(true){
		echo "<br> Basi majkata 2";
	}

	if(true){
		echo "<br> Basi majkata 3";
	}

	



	// $allPlanetsBuildings = DB::table('homeplanets')
 //            ->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
 //            ->join('powerplants','homeplanets.id' , '=','powerplants.homeplanet_id')
 //            ->join('metalmines','homeplanets.id' , '=','metalmines.homeplanet_id')
 //            ->select(
 //                'homeplanets.id',
 //                'goldmines.income as gold_income',
 //                'goldmines.cost_gold as gold_cost_gold',
 //                'goldmines.cost_metal as gold_cost_metal',
 //                'goldmines.cost_energy as gold_cost_energy',
 //                'goldmines.level as gold_level',
 //                'goldmines.upgrating_time as gold_upgrating_time',

 //                'metalmines.income as metal_income',
 //                'metalmines.cost_gold as metal_cost_gold',
 //                'metalmines.cost_metal as metal_cost_metal',
 //                'metalmines.cost_energy as metal_cost_energy',
 //                'metalmines.level as metal_level',
 //                'metalmines.upgrating_time as metal_upgrating_time',

 //                'powerplants.income as energy_income',
 //                'powerplants.cost_gold as energy_cost_gold',
 //                'powerplants.cost_metal as energy_cost_metal',
 //                'powerplants.cost_energy as energy_cost_energy',
 //                'powerplants.level as energy_level',
 //                'powerplants.upgrating_time as energy_upgrating_time'
 //                )
 //            ->get();

 //            foreach ($allPlanetsBuildings as $planetBuildings) {
 //            	$newLevel = $planetBuildings->gold_level + 1;
 //            	$newIncome = $planetBuildings->gold_income * $newLevel;
            	
 //            	App\Goldmine::where('id', '=' , $planetBuildings->id)->update([
 //            		'income' => $newIncome ,
 //            		'level' => $newLevel
 //            		]);
 //            }





});


// for testing
Route::get('/test_2' , function(){

	echo date_default_timezone_get().'<br>';
	 date_default_timezone_set('Europe/Bucharest');
	 echo date_default_timezone_get().'<br>';
	$mytime = Carbon\Carbon::now();
	echo $mytime->toDateTimeString('H');

	$curentUser = Auth::user();
	$curentUser->homeplanet->goldmine->upgrating_time = Carbon\Carbon::now();
	$curentUser->save();

	$timeInDB = $curentUser->homeplanet->goldmine->upgrating_time;
	echo "<br><br>Time saved in DB : " .$timeInDB;



	
	App\Goldmine::where('homeplanet_id','=',Auth::id())->update([
		// 'upgrating_time' => Carbon\Carbon::now()->addMinutes(60)
		'upgrating_time' => null
		]);
	App\Metalmine::where('homeplanet_id','=',Auth::id())->update([
		// 'upgrating_time' => Carbon\Carbon::now()->addMinutes(60)
		'upgrating_time' => null
		]);
	App\Powerplant::where('homeplanet_id','=',Auth::id())->update([
		// 'upgrating_time' => Carbon\Carbon::now()->addMinutes(60)
		'upgrating_time' => null
		]);



// play with date and time more 

	// $time_n = date('H:i');
	// echo "<br>" . $time_n;

	// var_dump($time_n);




	// echo "<br> <br> POST MAX SIZE " . ini_get('post_max_size');
	// echo "<br> <br> Upload MAX SIZE " . ini_get('upload_max_filesize' ."mb");
	// echo "<br> <br>";


		// $allhomeplanets = DB::table('homeplanets')
  //               ->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
  //               ->join('powerplants','homeplanets.id' , '=','powerplants.homeplanet_id')
  //               ->join('metalmines','homeplanets.id' , '=','metalmines.homeplanet_id')
  //               ->select('homeplanets.id','homeplanets.gold','homeplanets.metal','homeplanets.energy','goldmines.income as gold_income','metalmines.income as metal_income','powerplants.income as energy_income','goldmines.level as goldmines_level','metalmines.level as metalmines_level','powerplants.level as energy_level')
  //               ->get();

  //           // var_dump($allhomeplanets);
  //           foreach ($allhomeplanets as $homeplanet) {
  //               $homeplanet->gold += ($homeplanet->gold_income) * $homeplanet->goldmines_level;
  //               $homeplanet->metal += ($homeplanet->metal_income) * $homeplanet->metalmines_level;
  //               $homeplanet->energy += ($homeplanet->energy_income) * $homeplanet->energy_level;

  //               App\Homeplanet::where('id',$homeplanet->id)->update([
  //                   'gold' => $homeplanet->gold,
  //                   'metal' => $homeplanet->metal,
  //                   'energy' => $homeplanet->energy
  //                   ]);
  //           }

	

        
	
});


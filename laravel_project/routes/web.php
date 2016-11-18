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
});

Route::group(['middleware' => ['registersteptwo']],function(){
	Route::get('/register-step-2','RegistersteptwoController@stepTwoIndex');
	Route::post('/register-step-2','RegistersteptwoController@createDefaultGameClasses');
});




// TODO-MAK real 2D load map 








// for testing
Route::get('/test_2' , function(){

	echo date_default_timezone_get().'<br>';
	 date_default_timezone_set('Europe/Bucharest');
	 echo date_default_timezone_get().'<br>';
	$mytime = Carbon\Carbon::now();
	echo $mytime->toDateTimeString('H');

// play with date and time more 

	$time_n = date('H:i');
	echo "<br>" . $time_n;

	var_dump($time_n);




	echo "<br> <br> POST MAX SIZE " . ini_get('post_max_size');
	echo "<br> <br> Upload MAX SIZE " . ini_get('upload_max_filesize' ."mb");

	// income gold 10 per 2 minutes

	// $allhomeplanets = DB::table('homeplanets')
	// 	->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
	// 	->select()
	// 	->get();


		$allhomeplanets = DB::table('homeplanets')
                ->join('goldmines','homeplanets.id','=','goldmines.homeplanet_id')
                ->join('powerplants','homeplanets.id' , '=','powerplants.homeplanet_id')
                ->join('metalmines','homeplanets.id' , '=','metalmines.homeplanet_id')
                ->select('homeplanets.id','homeplanets.gold','homeplanets.metal','homeplanets.energy','goldmines.income as gold_income','metalmines.income as metal_income','powerplants.income as energy_income','goldmines.level as goldmines_level','metalmines.level as metalmines_level','powerplants.level as energy_level')
                ->get();

            // var_dump($allhomeplanets);
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

	// var_dump($allhomeplanets);
	// foreach ($allhomeplanets as $homeplanet) {
	// 	echo "<br>";
	// 	echo "id ".$homeplanet->id." Name ".$homeplanet->name." Gold before:  ". $homeplanet->gold;
	// 	// $homeplanet->gold += ($homeplanet->income) * $homeplanet->level;
	// 	// $homeplanet->gold = 1000;
	// 	echo "<br> Gold After: " . $homeplanet->gold;
	// 	// $homeplanet->save();
	// 	App\Homeplanet::where('id',$homeplanet->id)->update(['gold' => $homeplanet->gold]);
	// }

        
	
});


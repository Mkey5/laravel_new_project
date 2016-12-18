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
	Route::post('/battlestation/{user_id}','BattlestationController@battlestationHandling');

	Route::get('homeplanet','HomeplanetController@homeplanetIndex');
	Route::post('homeplanet' , 'HomeplanetController@homeplanetUpgrade');

	Route::get('orbitalbase','OrbitalbaseController@orbitalbaseIndex');
	Route::post('orbitalbase','OrbitalbaseController@orbitalbaseUpgradeOrCreate');

	Route::get('battleinprogress','BattleInProgressController@index');
});

Route::group(['middleware' => ['registersteptwo']],function(){
	Route::get('/register-step-2','RegistersteptwoController@stepTwoIndex');
	Route::post('/register-step-2','RegistersteptwoController@createDefaultGameClasses');
});




// TODO-MAK real 2D load map







Route::get('/testmak_3' , function(){
	$currentUser = Auth::user();
	$metalLevel = $currentUser->homeplanet->powerplant->level;
	echo "Power Level : ".$metalLevel;
            
            
});


// for testing
Route::get('/testmak_2' , function(){

});


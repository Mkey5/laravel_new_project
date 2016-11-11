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
});



// for testing
Route::get('test_stuff' , function(){

	echo date_default_timezone_get().'<br>';
	 date_default_timezone_set('Europe/Bucharest');
	 echo date_default_timezone_get().'<br>';
	$mytime = Carbon\Carbon::now();
	echo $mytime->toDateTimeString('H');


	$time_n = date('H:i');
	echo "<br>" . $time_n;

	var_dump($time_n);

	// play with date and time more 
});


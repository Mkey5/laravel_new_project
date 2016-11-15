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

Route::group(['middleware' => ['registersteptwo']],function(){
	Route::get('/register-step-2','RegistersteptwoController@stepTwoIndex');
	Route::post('/register-step-2','RegistersteptwoController@createDefaultGameClasses');
});



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



// this is the way to do this , rewrite the migrations and start to create the Controllers
	// $currentUser = Auth::user();
	// $homeplanet = new App\Homeplanet;
	// $homeplanet->name = 'My planet';
	// $homeplanet->user_id = $currentUser->id;
	// $homeplanet->gold = 200;
	// $homeplanet->metal = 500;
	// $homeplanet->x = 10;
	// $homeplanet->y = 5;
	// $homeplanet->save();

	// $orbitalbase = new App\Orbitalbase;
	// $orbitalbase->name = $currentUser->nickname . "'s Orbital Base";
	// $orbitalbase->user_id = $currentUser->id;
	// $orbitalbase->save();

	// $fleet = new App\Fleet;
	// $fleet->name = $currentUser->nickname . "'s Fleet";
	// $fleet->user_id = $currentUser->id;
	// $fleet->save();


	// // echo "The gold mada faka --> ".$currentUser->homeplanet->gold."   ".$currentUser->fleet->name." ". $currentUser->orbitalbase->name;
	// echo "This shit : " . $currentUser->homeplanet->x;

	$value_new = "maka_pepa";
        $nicknames = \DB::table('users')->select('nickname')->get();
        foreach ($nicknames as $nickname) {
        	echo "<br>" . $nickname->nickname;
            if($nickname->nickname == $value_new){
                echo "Ima gooo";
            }
        }


        $user = Auth::user();
        
        echo "<br> <br> Homeplanet id : " . $user->homeplanet->id;
	
});


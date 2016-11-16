<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeplanet extends Model
{

	// we don't whant timestamps colons in our table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = ['name'];

    

    public function createCoordinates($galaxy){
        $notUnique = true;
         while ($notUnique) {
            $x = rand(0,39);
            $y = rand(0,39);

            $homeplanetexists = \DB::table('homeplanets')
            ->where('x',$x)
            ->where('y',$y)
            ->first();

            if(is_null($homeplanetexists)){
                $this->x = $x;
                $this->y = $y;
                $this->galaxy = $galaxy;
                $notUnique = false; //break the while
            }
         }

         //TODO-MAK -> check if the "map" if full users = 1600 , / 40 * 40 / maps size 
    }



    //relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function goldmine(){
    	return $this->hasOne('App\Goldmine');
    }

    public function metalmine(){
    	return $this->hasOne('App\Metalmine');
    }

    public function powerplant(){
    	return $this->hasOne('App\Powerplant');
    }

}

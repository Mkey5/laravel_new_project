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
        $this->x = 10;
        $this->y = 10;
        $this->galaxy = $galaxy;

        // TODO
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

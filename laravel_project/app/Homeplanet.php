<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Homeplanet extends Model
{
    // public $user_id = null;
    // public $name;
    // private $gold = 7000;
    // public $metal = 1000;
    // public $energy = 1000;

	// we don't whant timestamps colons in our table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = ['name'];

    




    
    // public function setGoldAttribute($gold){
    //     $this->attributes['gold'] = $gold;
    // }



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

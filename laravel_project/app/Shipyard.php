<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipyard extends Model
{
    // public $cost_gold = 200;
    // public $cost_metal = 200;
    // public $cost_energy = 200;
    // public $level = 1;

    //relationships
    public function orbitalbase()
    {
        return $this->belongsTo('App\Orbitalbase');
    }

    public function frigate(){
    	return $this->hasMany('App\Frigate');
    }

    public function corvette(){
    	return $this->hasMany('App\Corvette');
    }

    public function destroyer(){
    	return $this->hasMany('App\Destroyer');
    }

    public function assaultcarrier(){
    	return $this->hasMany('App\Assaultcarrier');
    }
}

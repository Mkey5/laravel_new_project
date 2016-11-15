<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipyard extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

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

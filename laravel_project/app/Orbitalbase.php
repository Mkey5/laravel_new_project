<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orbitalbase extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = ['name'];



    //relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shipyard(){
    	return $this->hasOne('App\Shipyard');
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

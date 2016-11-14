<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{

	// public $frigates = 0;
	// public $corvettes = 0;
	// public $destroyers = 0;
	// public $assault_carriers = 0;
	// public $attack = 0;
	// public $defence = 0; 


    // we don't whant timestamps colons in our table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = ['name'];


    //relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}

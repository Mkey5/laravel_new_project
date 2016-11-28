<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corvette extends Model
{
   	// we don't whant timestamps colons in our table
    public $timestamps = false;

    public static $cost_gold = 35;
    public static $cost_metal = 50;
    public static $cost_energy = 70;
    public static $levelneeded = 2;

    public static $attack_def = 50;
    public static $defence_def = 50;


    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Orbitalbase');
    }
}

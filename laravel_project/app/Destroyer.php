<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destroyer extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    public static $cost_gold = 95;
    public static $cost_metal = 110;
    public static $cost_energy = 120;
    public static $levelneeded = 3;

    public static $attack_def = 100;
    public static $defence_def = 80;


    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Orbitalbase');
    }
}

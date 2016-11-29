<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destroyer extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    public static $cost_gold = 105;
    public static $cost_metal = 200;
    public static $cost_energy = 170;
    public static $levelneeded = 3;

    public static $attack_def = 160;
    public static $defence_def = 110;


    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Orbitalbase');
    }
}

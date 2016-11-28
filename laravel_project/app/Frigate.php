<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frigate extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    public static $cost_gold = 20;
    public static $cost_metal = 30;
    public static $cost_energy = 50;
    public static $levelneeded = 1;

    public static $attack_def = 30;
    public static $defence_def = 20;



    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Orbitalbase');
    }
}

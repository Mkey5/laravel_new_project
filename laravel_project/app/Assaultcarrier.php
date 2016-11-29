<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assaultcarrier extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    public static $cost_gold = 350;
    public static $cost_metal = 600;
    public static $cost_energy = 820;
    public static $levelneeded = 5;


    public static $attack_def = 500;
    public static $defence_def = 480;



    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Orbitalbase');
    }
}

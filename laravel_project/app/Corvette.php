<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Corvette extends Model
{
   	// public $attack = 50;
    // public $defence = 50;
    // public $cost_gold = 35;
    // public $cost_metal = 50;
    // public $cost_energy = 70;
    // public $levelneeded = 2;
    // public $level = 1;

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

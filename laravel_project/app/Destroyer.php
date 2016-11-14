<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destroyer extends Model
{
    // public $attack = 100;
    // public $defence = 80;
    // public $cost_gold = 95;
    // public $cost_metal = 110;
    // public $cost_energy = 120;
    // public $levelneeded = 3;
    // public $level = 1;

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

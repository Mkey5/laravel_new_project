<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frigate extends Model
{
    // public $attack = 30;
    // public $defence = 20;
    // public $cost_gold = 20;
    // public $cost_metal = 30;
    // public $cost_energy = 50;
    // public $levelneeded = 1;
    // public $level = 1;

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

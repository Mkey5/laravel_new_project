<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Assaultcarrier extends Model
{
    // public $attack = 500;
    // public $defence = 480;
    // public $cost_gold = 350;
    // public $cost_metal = 600;
    // public $cost_energy = 820;
    // public $levelneeded = 5;
    // public $level = 1;

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

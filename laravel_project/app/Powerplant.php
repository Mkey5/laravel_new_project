<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Powerplant extends Model
{
    // public $income = 50;
    // public $cost_gold = 100;
    // public $cost_metal = 100;
    // public $cost_energy = 100;
    // public $level = 1;


    //relationships
    public function homeplanet()
    {
        return $this->belongsTo('App\Homeplanet');
    }
}

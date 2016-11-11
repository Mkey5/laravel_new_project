<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Powerplant extends Model
{
    //


    //relationships
    public function homeplanet()
    {
        return $this->belongsTo('App\Homeplanet');
    }
}

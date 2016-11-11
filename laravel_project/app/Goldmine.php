<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Goldmine extends Model
{
    //



    //relationships
    public function homeplanet()
    {
        return $this->belongsTo('App\Homeplanet');
    }
}

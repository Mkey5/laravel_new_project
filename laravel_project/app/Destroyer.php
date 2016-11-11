<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Destroyer extends Model
{
    //

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

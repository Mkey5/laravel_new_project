<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frigate extends Model
{
    //

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

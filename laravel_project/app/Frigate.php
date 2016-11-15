<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frigate extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    //relationships
    public function shipyard()
    {
        return $this->belongsTo('App\Shipyard');
    }
}

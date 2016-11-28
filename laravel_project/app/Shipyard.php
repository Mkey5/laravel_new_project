<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shipyard extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    //relationships
    public function orbitalbase()
    {
        return $this->belongsTo('App\Orbitalbase');
    }

    
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Metalmine extends Model
{
    // we don't whant timestamps colons in our table
    public $timestamps = false;


    //relationships
    public function homeplanet()
    {
        return $this->belongsTo('App\Homeplanet');
    }
}

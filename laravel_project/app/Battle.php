<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Battle extends Model
{
    public $timestamps = false;
	//relationships
    public function users()
    {
        return $this->belongsToMany('App\User' , 'battle_user');
    }
}

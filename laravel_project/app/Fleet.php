<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fleet extends Model
{

	
    // we don't whant timestamps colons in our table
    public $timestamps = false;

    //The attributes that are mass assignable.
    protected $fillable = ['name'];


    //relationships
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
}

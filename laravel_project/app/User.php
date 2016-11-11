<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    //relationships
    public function homeplanet()
    {
        return $this->hasOne('App\Homeplanet');
    }

    public function orbitalbase(){
        return $this->hasOne('App\Orbitalbase');
    }

    public function fleet(){
        return $this->hasOne('App\Fleet');
    }

}

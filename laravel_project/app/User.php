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
        'name', 'email', 'password','nickname',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    // setter for saving the name with capital first letter
    public function setNameAttribute($value){
        $this->attributes['name'] = ucfirst($value);
    }

    // setter for nickname - no empty spaces
    public function setNicknameAttribute($value){
        $this->attributes['nickname'] = str_replace(" ", "_", $value) ;
    }

    // crypting the password
    public function setPasswordAttribute($value){
        $this->attributes['password'] = bcrypt($value);
    }



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

     public function battles()
    {
        return $this->belongsToMany('App\Battle' , 'battle_user');
    }

}

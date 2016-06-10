<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'avatar', 'provider', 'provider_id', 'alamat', 'nohp'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function event()
    {
        return $this->belongsToMany('App\Event','user_event');
    }

    public function score()
    {
        return $this->hasOne('App\Score');
    }

}

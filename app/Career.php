<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Career extends Model
{
    protected $table = 'career';
    public $timestamp = false;

    public funtion users(){
        return $this->belongsToMany('App\User','user_career');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizcategory extends Model
{
    protected $table = 'quizcategory';

    protected $fillable = ['name'];

    public function interest()
    {
      return $this->belongsToMany('App\Interest','quizcategory_interest');
    }

    public function quiz()
    {
      return $this->hasOne('App\Quiz');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $fillable = ['name_interest'];
    
    public function event()
    {
      return $this->belongsToMany('App\Event','event_interest');
    }

    public function quizcategory()
    {
      return $this->belongsToMany('App\Quizcategory','quizcategory_interest');
    }
}

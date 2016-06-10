<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{

    protected $fillable = ['music', 'linguistik', 'sport', 'interpersonal', 'spasial', 'logic', 'intrapersonal'];

    public function user()
    {
      return $this->belongsTo('App\User');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';

    protected $fillable = ['soal'];

    public function quizcategory()
    {
      return $this->belongsTo('App\Quizcategory');
    }
}

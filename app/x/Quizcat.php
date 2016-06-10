<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quizcat extends Model
{
    protected $table = 'quizcat';
    protected $fillable = ['name'];
    public $timestamps = false;

    public function quiz(){
        return $this->hasOne('App\Quiz');
    }
    
    public function interest(){
    	return $this->belongsToMany('App\Interest','interest_quizcat');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Interest extends Model
{
    protected $table = 'interest';
    protected $fillable = ['name_interest'];
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User','user_interest');
    }
    
    public function events(){
        return $this->belongsToMany('App\Events','events_interest');
    }
    
    public function quizcat(){
    	return $this->belongsToMany('App\Quizcat','interest_quizcat');
    }
}

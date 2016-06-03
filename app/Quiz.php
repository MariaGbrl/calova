<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quiz';
    protected $fillable = ['soal','quizcat_id'];
    public $timestamps = false;

    public function quizcat(){
        return $this->hasOne('App\Quizcat');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Userquiz extends Model
{
    protected $table = 'user_score';
    protected $fillable = ['score_musik','score_linguistik','score_sport','score_interpersonal','score_spasial','score_logic','score_intrapersonal','user_id'];
    public $timestamps = false;

    public function users(){
        return $this->hasOne('App\User');
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IntelegenceUser extends Model
{
    protected $table = 'intelegence_user';
    public $timestamp = false;

    public function users()
    {
        return $this->belongsTo('App\User');
    }
}

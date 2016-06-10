<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class event extends Model
{
    protected $fillable = ['nama_event','tgl_event','organizer','location','link','isi','highlight','gambar_event','deadline','biaya','persyaratan','type'];
    
    public function user()
    {
      return $this->belongsToMany('App\User','user_event');
    }

    public function interest()
    {
      return $this->belongsToMany('App\Interest','event_interest');
    }
}

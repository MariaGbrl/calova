<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
    protected $table = 'events';
    protected $fillable = ['nama_event','tgl_event','organizer','location','link','isi','highlight','gambar_event','deadline','biaya','persyaratan','type'];
    public $timestamps = false;

    public function users(){
        return $this->belongsToMany('App\User','user_events');
    }

    public function interest(){
        return $this->belongsToMany('App\Interest','events_interest');
    }

}

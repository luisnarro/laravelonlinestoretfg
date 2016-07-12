<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Artist extends Model
{

    protected $fillable = ['name'];

    public function disc_list()
    {
    	return $this->belongsToMany('App\Disc', 'artist_to_disc', 'artist_id', 'disc_id');
    }
}

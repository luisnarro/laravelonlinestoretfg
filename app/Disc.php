<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disc extends Model
{
	
    protected $fillable = ['name'];

    public function group_list()
    {
    	return $this->belongsToMany('App\Group', 'group_to_disc', 'disc_id', 'group_id');
    }

    public function artist_list()
    {
    	return $this->belongsToMany('App\Artist', 'artist_to_disc', 'disc_id', 'artist_id');
    }

}
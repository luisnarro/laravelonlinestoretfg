<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    
    protected $fillable = ['name'];

    public function disc_list()
    {
    	return $this->belongsToMany('App\Disc', 'group_to_disc', 'group_id', 'disc_id');
    }

    public function artist_list()
    {
    	return $this->belongsToMany('App\Artist', 'artist_to_group', 'group_id', 'artist_id');
    }

}
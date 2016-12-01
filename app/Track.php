<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
	protected $fillable = ['name'];

	public function disc_list()
    {
        return $this->belongsToMany('App\Disc', 'track_to_disc', 'track_id', 'disc_id');
    }


}

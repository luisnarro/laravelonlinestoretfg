<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Disc extends Model
{
    protected $fillable = ['name'];

    public function group_list()
    {
    	return $this->belongsToMany('App\Group', 'group_to_disc', 'disc_id', 'group_id');
    }

}
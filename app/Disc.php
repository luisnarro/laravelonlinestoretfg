<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Disc extends Model
{
    protected $fillable = ['name'];


    /* Devuelve una lista con los últimos discos añadidos */
    public function lastDiscsAdded()
    {
    	/*return $this->*/
    }

    public function groups()
    {
    	return $this->belongsToMany('App\Group', 'group_to_disc', 'disc_id', 'group_id');
    }
}

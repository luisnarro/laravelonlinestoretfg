<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Style extends Model
{
    protected $fillable = ['name'];

        public function disc_list()
    {
        return $this->belongsToMany('App\Disc', 'disc_to_style', 'style_id', 'disc_id');
    }

}

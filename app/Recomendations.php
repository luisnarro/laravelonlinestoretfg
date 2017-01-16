<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recomendations extends Model
{
    public function getAlbums()
    {
		$discs = array();

    	foreach (explode(',', $this->rec_discs) as $disc_id) {
    		array_push($discs, Disc::find($disc_id));
    	}
    	return $discs;
    }
}

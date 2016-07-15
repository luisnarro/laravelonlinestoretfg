<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Gloudemans\Shoppingcart\Contracts\Buyable;

class Disc extends Model implements Buyable
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

    public function style_list()
    {
        return $this->belongsToMany('App\Style', 'disc_to_style', 'disc_id', 'style_id');
    }

    /*
    * Métodos de la interfaz "Buyable"
    */

     /**
     * Get the identifier of the Buyable item.
     *
     * @return int|string
     */
    public function getBuyableIdentifier()
    {

    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription()
    {

    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice()
    {

    }

}
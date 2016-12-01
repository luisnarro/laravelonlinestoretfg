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

    public function track_list()
    {
        return $this->belongsToMany('App\Track', 'track_to_disc', 'disc_id', 'track_id');
    }

    public function addNew($input)
    {
        
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
        return strval($this->attributes['id']);
    }

    /**
     * Get the description or title of the Buyable item.
     *
     * @return string
     */
    public function getBuyableDescription()
    {
        return $this->attributes['name'];
    }

    /**
     * Get the price of the Buyable item.
     *
     * @return float
     */
    public function getBuyablePrice()
    {
        return 99;
    }

}
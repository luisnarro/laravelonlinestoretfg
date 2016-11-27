<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class RecomendationIn extends Model
{

    public static function set_user_discs($userid, $discid)
    {
    	$userdiscs = RecomendationIn::where('user_id', '=', $userid)->first();
    	if($userdiscs === null)
    	{
    		DB::table('recomendation_ins')->insert(['user_id' => $userid, 'discs' => $discid]);
    	}else
    	{
    		//$userdiscs = RecomendationIn::where('user_id', '=', $userid)->first();

    		$arraydisc = explode(",", $userdiscs->discs);
    		if(count($arraydisc) < 4)
	    	{
	    		array_push($arraydisc, $discid);
	    	}else
	    	{
	    		array_shift($arraydisc);
	    		array_push($arraydisc, $discid);
	    	}

	    	DB::table('recomendation_ins')->where('user_id', $userid)->update(['discs' => implode(",", $arraydisc)]);
    	}
    }

    public static function request_rec_system($user_id)
    {
    	$req_params = self::get_user_discs($user_id);

    	// Get cURL resource
		$curl = curl_init();
		// Set some options - we are passing in a useragent too here
		curl_setopt_array($curl, array(
		    CURLOPT_RETURNTRANSFER => 1,
		    CURLOPT_URL => 'http://localhost:8081/jsrilanda-music-web/GenerarRecomendaciones?disclist='.$req_params,
		    CURLOPT_USERAGENT => 'Codular Sample cURL Request'
		));
		// Send the request & save response to $resp
		$resp = curl_exec($curl);
		curl_close($curl);
		$resp = preg_replace("/&(?!#?[a-z0-9]+;)/", "&amp;",$resp);
		$recomend_xml = simplexml_load_string($resp);
		//var_dump($recomend_xml->disc[0]->disc_name);

		$scrappingAlbum = LastFmScrappingAlbum::getAlbumInfo($recomend_xml->disc[0]->disc_artist, $recomend_xml->disc[0]->disc_name);
		var_dump($scrappingAlbum);
		
    }

    public static function get_user_discs($user)
    {
    	$req_string = '';
    	$userdiscs = RecomendationIn::where('user_id', '=', $user)->first();
    	$arraydisc = explode(',', $userdiscs->discs);
    	foreach ($arraydisc as $disc) {
    		$ddbb_disc = Disc::where('id', $disc)->first();
    		$artist = Artist::where('id', $ddbb_disc->attributes['artist_id'])->first();
    		$partial = $artist->attributes['name'].'#'.$ddbb_disc->attributes['name'].';';
    		$req_string .= $partial;
    	}
    	$req_string = substr($req_string, 0, -1);
    	return urlencode($req_string);
    }
}
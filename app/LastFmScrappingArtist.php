<?php

namespace App;
use App\Artist;
use Exception;

class LastFmScrappingArtist
{	
    public $xmlInfo;
    public $name;
    public $mbid;
    public $bio;
    public $artistInstance;
    private static $instance = null;

    private function __construct($xmlInfo)
    {
        if (!$xmlInfo->artist) {
             throw new Exception("No se ha encontrado informaión del artista.");
        }
        $this->name = $this->checkParameter($xmlInfo->artist->name);
        $this->mbid = $this->checkParameter($xmlInfo->artist->mbid);
        $this->bio = $this->checkParameter($this->checkAttributeExists($xmlInfo->artist->bio)->summary);
    }

    public static function loadXML($xmlInfo) {
	    try {
	        self::$instance = new LastFmScrappingArtist($xmlInfo);
	        return self::$instance;
	    } catch (Exception $unfe) {
	        return null;
	    }
    }

    public static function getArtistInfo($artistname)
    {
        $url="http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".urlencode($artistname)."&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);
        $xmlArtist = simplexml_load_string($data);

        try {
            self::$instance = new LastFmScrappingArtist($xmlArtist);
            return self::$instance;
        } catch (Exception $unfe) {
            return null;
        }
    }

    private function checkAttributeExists($attribute)
    {
        $result = null;
        if($attribute != null)
        {
            $result = $attribute;
        }

        return $result;
    }

    private function checkParameter($parameter)
    {
        $result = null;
        if ($parameter != null && $parameter->asXML()) 
        {
            $result = strip_tags($parameter->asXML());
        }

        return $result;
    }

    public function checkArtistIsAdded()
    {
        if(!is_null($this->mbid))
        {
            $this->artistInstance = Artist::where('lastfm_id', '=', $this->mbid)->first();
        }else
        {
            $this->artistInstance = Artist::where('name', '=', $this->name)->first();
        }
        return !is_null($this->artistInstance);
    }

    public function addToDatabase()
    {
        if(!$this->checkArtistIsAdded())
        {
            $artist = new Artist;
            $artist->name = $this->name;
            $artist->bio = $this->bio;
            $artist->lastfm_id = $this->mbid;
            $artist->save();
        }
    	
    }
}

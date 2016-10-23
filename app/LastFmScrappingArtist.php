<?php

namespace App;
use Exception;

class LastFmScrappingArtist
{	
    public $xmlInfo;
    public $name;
    public $mbid;
    public $bio;
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
}

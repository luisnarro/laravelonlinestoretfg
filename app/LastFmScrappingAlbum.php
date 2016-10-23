<?php

namespace App;
use Disc;
use Exception;

class LastFmScrappingAlbum
{
	
    public $xmlInfo;
    public $name;
    public $mbid;
    public $year;
    public $tracks;
    public $nsongs;
    public $totalDuration;
    public $artist_name;
    public $discInstance;
    private static $instance = null;

    private function __construct($xmlInfo)
    {
        if (!$xmlInfo->album) {
             throw new Exception("No se ha encontrado informaión del Album.");
        }
        $this->name = $this->checkParameter($xmlInfo->album->name);
        $this->mbid = $this->checkParameter($xmlInfo->album->mbid);
        $this->year = $this->checkParameter($this->checkAttributeExists($xmlInfo->album->wiki)->published);
        $this->tracks = $this->checkParameter($this->checkAttributeExists($xmlInfo->album->tracks)->track);
        $this->nsongs = count($this->checkAttributeExists($xmlInfo->album->tracks->track));
        $this->totalDuration = $this->calculateDuration($this->checkAttributeExists($xmlInfo->album->tracks->track));
        $this->artist_name = $this->checkParameter($xmlInfo->album->artist);
    }

    public static function loadXML($xmlInfo) {
        try {
            self::$instance = new LastFmScrappingAlbum($xmlInfo);
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

    private function calculateDuration($tracks)
    {
        $result = 0;
        foreach ($tracks as $song) 
        {
            $result += $song->duration;
        }
        $result = $result/60;

        return $result;
    }

    public function checkAlbumIsAdded()
    {
        if(!is_null($this->mbid))
        {
            $this->discInstance = Disc::where('mbid', '=', $this->mbid)->first();
        }else
        {
            $this->discInstance = Disc::where('title', '=', $this->name)->first();
        }
        return !is_null($tis->discInstance);
    }
}

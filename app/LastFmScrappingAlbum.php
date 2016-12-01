<?php

namespace App;
use App\Disc;
use App\Artist;
use Illuminate\Support\Facades\DB;
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
    public $artist_id;
    public $summary;
    public $tags = array();
    public $tracklist = array();
    public $imgpath;
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
        $this->settags($xmlInfo->album->tags);
        $this->settracks($this->checkAttributeExists($xmlInfo->album->tracks->track));
        $this->summary = $this->checkParameter($this->checkAttributeExists($xmlInfo->album->wiki)->summary);
        $this->imgpath = '/images'.'/'.$this->mbid.'.png';
        $this->save_image($this->checkParameter($xmlInfo->album->image[2]),'C:/xampp/htdocs/proyectotfg/public/images/'.$this->mbid.'.png');

    }

    public static function getAlbumInfo($artistname, $albumname)
    {
        $url="http://ws.audioscrobbler.com/2.0/?method=album.getinfo&artist=".urlencode($artistname)."&album=".urlencode($albumname)."&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);

        $data = curl_exec($ch);
        curl_close($ch);
        $xmlAlbum = simplexml_load_string($data);

        try {
            self::$instance = new LastFmScrappingAlbum($xmlAlbum);
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
            $this->discInstance = Disc::where('lastfm_id', '=', $this->mbid)->first();
        }else
        {
            $this->discInstance = Disc::where('name', '=', $this->name)->first();
        }
        return !is_null($this->discInstance);
    }

    private function settags($taglist)
    {
        foreach ($taglist->tag as $tag) {
            $tagname = (string)$tag->name;
            array_push($this->tags, $tagname);
            $style = Style::firstOrCreate(['name' => $tagname]);
        }
    }

    private function settracks($tracklist)
    {
        $trackadd;
        foreach ($tracklist as $track) {
            $trackadd['name'] = (string)$track->name;
            $trackadd['url'] = (string)$track->url;
            $trackadd['duration'] = (int)$track->duration;
            array_push($this->tracklist, $trackadd);
        }
    }

    private function save_image($inPath,$outPath)
    {
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        ); 

        $contents=file_get_contents($inPath, false, stream_context_create($arrContextOptions));
        file_put_contents($outPath,$contents);
    }

    public function addToDatabase()
    {
        if(!$this->checkAlbumIsAdded())
        {
            //recuperar el id de la bbdd del artista a partir del mbid
            $artist = Artist::where('lastfm_id', '=', $this->artist_id)->first();

            $album = new Disc;
            $album->name = $this->name;
            if($this->year == null)
            {
                $album->year = 0;
            }else
            {
                $album->year = $this->year;
            }
            if($this->mbid != null)
            {
                $album->lastfm_id = $this->mbid;
                $album->format = 1;
            $album->nsongs = $this->nsongs;
            $album->totalduration = $this->totalDuration;
            $album->artist_id = $artist->id;
            $album->img_path = $this->imgpath;
            $album->summary = $this->summary;
            
            $album->save();
            $addedAlbum = Disc::where('lastfm_id', '=', $this->mbid)->first();
            $artist->disc_list()->attach($addedAlbum->id);
            foreach ($this->tags as $tag) {
                $style = Style::where('name', '=', $tag)->first();
                $addedAlbum->style_list()->attach($style->id);
            }
            //$addedAlbum->style_list()->attach($style->id);
            }            
        }
    }
}

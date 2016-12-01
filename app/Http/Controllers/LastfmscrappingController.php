<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LastFmScrappingAlbum;
use App\LastFmScrappingArtist;
use App\Http\Requests;

class LastfmscrappingController extends Controller
{
   
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function albumsbytag(Request $request)
    {
        if ($request->has('tag'))
        {
            $url="http://ws.audioscrobbler.com/2.0/?method=tag.gettopalbums&tag=".$request->input('tag')."&limit=10&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

            $data = curl_exec($ch); // execute curl request
            curl_close($ch);

            $xml = simplexml_load_string($data);
            $albums = $xml->albums[0];
        }
        /*
        foreach ($albums as $attr => $valor){ ?>
            <a href=<?php echo ($valor->url); ?>><?php echo ($valor->name); ?></a></br>
            <img src=<?php echo ($valor->image[2]); ?> alt=<?php echo ($valor->name); ?>>
            </br>
        <?php 
        }
        */
        //return redirect()->back()->with('data', $albums);
        return view('backend/shop_backend', ['data' => $albums]);
    }

    public function addalbum(Request $request, $albumname, $artistname)
    {
        $albumInfo = null;
        $artist = null;
        $album = LastFmScrappingAlbum::getAlbumInfo($artistname, $albumname);

        if ($album != null)
        {
            /*if($album->checkAlbumIsAdded())
            {
                // El disco se encuentra en la BBDD (en la tienda)
            }else
            {*/
                $url="http://ws.audioscrobbler.com/2.0/?method=artist.getinfo&artist=".urlencode($album->artist_name)."&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                curl_setopt($ch, CURLOPT_URL, $url);

                $data = curl_exec($ch);
                curl_close($ch);
                $xmlArtist = simplexml_load_string($data);
                $artist = LastFmScrappingArtist::loadXML($xmlArtist);
                //var_dump($artist);
                $artist->addToDatabase();

                /*if (!$artist->checkArtistIsAdded) 
                {
                    $artist->addToDatabase();
                }*/

                $albumInfo = array($album->name, $album->mbid, $album->year, $album->nsongs,
                 $album->totalDuration, $album->artist_name, $album->mbid, $artist->mbid, $album->summary, $album->tracklist);
            //}
        }

        $album->artist_id = $artist->mbid;
        session()->put('albumtoadd', $album);

        return view('backend/shop_backend_addAlbumReview', ['albumData' => $albumInfo]);
    }

    public function addalbumtodb(Request $request)
    {
        $album = session()->get('albumtoadd');
        if(!is_null($album)){
            if(is_null($album->year)){ $album->year = $request->anio;}
            if(is_null($album->summary)){ $album->summary = $request->summary;}
            //var_dump($album);
            $album->addToDatabase();
        }

        return view('backend/shop_backend', [
        ]);
    }
}
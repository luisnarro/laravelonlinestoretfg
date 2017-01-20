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
        //var_dump($album);
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

    public function useraddalbumtodb(Request $request)
    {
        //Añadir la info introducida por el usuario en la bbdd
        return view('backend/shop_backend', [
        ]);
    }

    public function gestionPedidos(Request $request)
    {
        //Redireccionar a la gestión de pedidos
        return view('backend/order_management', [
        ]);
    }

    public function searchalbum(Request $request)
    {
        if ($request->has('searchstring'))
        {
            $url="http://ws.audioscrobbler.com/2.0/?method=album.search&album=".$request->input('searchstring')."&api_key=31b17cdc13c44d7b1f8d7bd80afa6b14";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_URL, $url);    // get the url contents

            $data = curl_exec($ch); // execute curl request
            curl_close($ch);

            $xml = simplexml_load_string($data);
            $albums = $xml->albums[0];
        }
        var_dump($data);

        return view('backend/shop_backend', 
            [/*'data' => $albums*/]);
    }

    public function rellenarbbdd(Request $request)
    {
        //leer archivo y guardar cada disco
        $myfile = fopen("C:\Users\LuisNarro\Desktop\prueba_importar.csv", "r") or die("Unable to open file!");
        //var_dump(fgets($myfile));
        while(!feof($myfile)) {
            //echo fgets($myfile) . "<br>";
            $line = fgets($myfile);
            if(strlen($line) > 0)
            {
                $album_co = explode(',', $line)[0];
                $artis_co = explode(',', $line)[1];
                $album = substr($album_co, 1, strlen($album_co)-2);
                $artist = substr($artis_co, 1, strlen($artis_co)-4);
                $this->addalbum($request, $album, $artist);
                $this->addalbumtodb($request);
                //var_dump($album);
                //var_dump($artist);
            }
           
        }
        fclose($myfile);

        return view('backend/shop_backend', [
            ]);
    }
}
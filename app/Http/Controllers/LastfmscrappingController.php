<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        //comprobar si existe en la BBDD antes

        return view('home', ['data' => $albumname]);
    }
}


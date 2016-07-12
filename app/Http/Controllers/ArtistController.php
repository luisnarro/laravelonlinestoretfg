<?php

namespace App\Http\Controllers;


use App\Artist;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ArtistController extends Controller
{

    protected $artists;

    public function __construct(Artist $artists)
    {
    	//$this->middleware('auth');
        $this->middleware('auth', ['except' => ['artistInfo']]);

        $this->artists = $artists;
    }

    public function index(Request $request)
    {

        // Nada de momento
    }

    public function artistInfo(Request $request, $id)
    {
        $artist = Artist::find($id)->get();

        return view('artists.info', [
            'artist' => $artist,
        ]);
    }


    // Funciónes de administración de artistas.
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		]);

    	$request->user()->groups()->create([
    		'name' => $request->name,
    		]);

    	return redirect('/artists');
    }

    public function destroy(Request $request, Artist $artist)
    {
        $this->authorize('destroy', $artist);

        $artist->delete();

        return redirect('/artists');
    }

}
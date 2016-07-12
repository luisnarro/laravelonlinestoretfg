<?php

namespace App\Http\Controllers;


use App\Disc;
use Cart;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DiscRepository;

class DiscController extends Controller
{

    protected $discs;

    public function __construct(Disc $discs)
    {
    	//$this->middleware('auth');
        $this->middleware('auth', ['except' => ['index']]);

        $this->discs = $discs;
    }

    // Lista los últimos discos incorporados
    public function index(Request $request)
    {

        Cart::instance('shopping')->add('192ao12', 'Product 1', 1, 9.99);
        $discList = Disc::all();

        foreach ($discList as $disc) {
            $groups = Disc::find($disc->id)->group_list()->get();
            $artists = Disc::find($disc->id)->artist_list()->get();
            $disc['groups'] = $groups;
            $disc['artists'] = $artists;
        }

        return view('discs.index', [
            'discs' => $discList,
        ]);
    }


    // Funciónes de administración de discos.
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		]);

    	$request->user()->discs()->create([
    		'name' => $request->name,
    		]);

    	return redirect('/discs');
    }

    public function destroy(Request $request, Disc $disc)
    {
        $this->authorize('destroy', $disc);

        $disc->delete();

        return redirect('/discs');
    }

}

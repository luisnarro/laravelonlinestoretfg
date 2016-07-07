<?php

namespace App\Http\Controllers;


use App\Disc;
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


        $discList = Disc::all();
        $grupos = Disc::find(1)->group_list()->get();
        $prueba = null;

        foreach ($grupos as $grupo) {
            $prueba = $grupo->name;
        }

        return view('discs.index', [
            'discs' => $discList,
            'prueba' => $grupos,
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

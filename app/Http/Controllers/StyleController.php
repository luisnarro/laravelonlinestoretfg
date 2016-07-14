<?php

namespace App\Http\Controllers;


use App\Style;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class StyleController extends Controller
{

    protected $styles;

    public function __construct(Style $styles)
    {
    	//$this->middleware('auth');
        $this->middleware('auth', ['except' => ['index', 'styleDiscs']]);

        $this->styles = $styles;
    }

    public function index(Request $request)
    {

    }

    public function styleDiscs(Request $request, $id)
    {
        
    }


    // Funciónes de administración de estilos.
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		]);

    	$request->user()->styles()->create([
    		'name' => $request->name,
    		]);

    	return redirect('/styles');
    }

    public function destroy(Request $request, Style $style)
    {
        $this->authorize('destroy', $style);

        $style->delete();

        return redirect('/styles');
    }

}
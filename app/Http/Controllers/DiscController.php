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

    public function __construct(DiscRepository $discs)
    {
    	$this->middleware('auth');

        $this->discs = $discs;
    }

    public function index(Request $request)
    {

    	return view('discs.index', [
            'discs' => $this->discs->forUser($request->user()),
        ]);
    }

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

<?php

namespace App\Http\Controllers;


use App\Disc;
use App\Style;
use DB;
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
        $this->middleware('auth', ['except' => ['index', 'discs_by_style']]);

        $this->discs = $discs;
    }

    // Lista los últimos discos incorporados
    public function index(Request $request)
    {

        $discList = Disc::all();

        $discList = $this->get_disc_info($discList);

        

        return view('discs.index', [
            'discs' => $discList,
        ]);
    }

    public function discs_by_style(Request $request, $id)
    {
        $style = Style::find($id);
        //$style_name = DB::table('styles')->where('id', $id)->value('name');
        $discs = $style->disc_list()->get();
        $discs = $this->get_disc_info($discs);
        $style_name = $style->name;

        return view('discs.style_discs', [
            'discs' => $discs,
            'style_name' => $style_name,
        ]);
    }

    private function get_disc_info($discList)
    {
        foreach ($discList as $disc) {
            $groups = Disc::find($disc->id)->group_list()->get();
            
            foreach ($groups as $group) {
                $group['artists'] = $group->artist_list()->get();
            }

            $disc['groups'] = $groups;
            $disc['styles'] = Disc::find($disc->id)->style_list()->get();
        }

        return $discList;
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

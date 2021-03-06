<?php

namespace App\Http\Controllers;


use App\Disc;
use App\Style;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\DiscRepository;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class DiscController extends Controller
{

    protected $discs;
    private $perPage = 5;

    public function __construct(Disc $discs)
    {
    	//$this->middleware('auth');
        $this->middleware('auth', ['except' => ['index', 'discs_by_style', 'discos_formato', 'discs_details']]);

        $this->discs = $discs;
    }

    // Lista los últimos discos incorporados
    public function index(Request $request)
    {

        $currentPage = LengthAwarePaginator::resolveCurrentPage();
        
        $discsTotalCount = Disc::count();
        $array = array_fill(0,$discsTotalCount-1, null);
        $skip = $currentPage * $this->perPage;
        $discList = Disc::skip($skip)->take($this->perPage)->get();
        $discList = $this->get_disc_info($discList);

        $discListPag = $this->paginate($array, $currentPage, $request);

        return view('discs.index', [
            'discs' => $discList,
            'discspag' => $discListPag,
        ]);
    }

    private function paginate($discList, $currentPage, $request)
    {
        $col = new Collection($discList);
        $currentPageSearchResults = $col->slice(($currentPage - 1) * $this->perPage, $this->perPage)->all();
        $discList = new LengthAwarePaginator($currentPageSearchResults, count($col), $this->perPage);

        $discList->setPath($request->url());
        return $discList;
    }

    public function discs_by_style(Request $request, $id)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $style = Style::find($id);

        $discsTotalCount = $style->disc_list()->count();
        //$discsTotalCount = $discStyle->count();
        $array = array_fill(0,$discsTotalCount-1, null);

        $skip = $currentPage * $this->perPage;
        $discs = $style->disc_list()->skip($skip)->take($this->perPage)->get();

        $discs = $this->get_disc_info($discs);
        $style_name = $style->name;

        $discListPag = $this->paginate($array, $currentPage, $request);

        return view('discs.style_discs', [
            'discs' => $discs,
            'style_name' => $style_name,
            'discspag' => $discListPag,
        ]);
    }

    public function discos_formato(Request $request, $id)
    {
        $currentPage = LengthAwarePaginator::resolveCurrentPage();

        $discsTotalCount = Disc::where('format', $id)->count();
        $array = array_fill(0,$discsTotalCount-1, null);
        $skip = $currentPage * $this->perPage;

        $discList = Disc::where('format', $id)->skip($skip)->take($this->perPage)->get();
        $discList = $this->get_disc_info($discList);

        $discListPag = $this->paginate($array, $currentPage, $request);

        return view('discs.index', [
            'discs' => $discList,
            'discspag' => $discListPag,
        ]);
    }

    public function discs_details(Request $request, $id)
    {
        $disc = Disc::where('id', $id)->get()->first();
        $disc['artist'] = Disc::find($disc->id)->artist_list()->get();
        $disc['styles'] = Disc::find($disc->id)->style_list()->get();
        $disc['tracks'] = Disc::find($disc->id)->track_list()->get();
        return view('discs.detail', [
            'disc' => $disc,
        ]);
    }

    private function get_disc_info($discList)
    {
        foreach ($discList as $disc) {
            //$groups = Disc::find($disc->id)->group_list()->get();
            $artist = Disc::find($disc->id)->artist_list()->get();
            $disc['artist'] = $artist;
            
            /*
            foreach ($groups as $group) {
                $group['artists'] = $group->artist_list()->get();
            }
            */

            //$disc['groups'] = $groups;
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
            'year' => $request->year,
            'format' => $request->format,
            'image' => $request->image,
    		]);
        

        //artista
        //grupo

    	return redirect('/discs');
    }

    public function destroy(Request $request, Disc $disc)
    {
        $this->authorize('destroy', $disc);

        $disc->delete();

        return redirect('/discs');
    }

}

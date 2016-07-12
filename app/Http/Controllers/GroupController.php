<?php

namespace App\Http\Controllers;


use App\Group;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class GroupController extends Controller
{

    protected $groups;

    public function __construct(Group $groups)
    {
    	//$this->middleware('auth');
        $this->middleware('auth', ['except' => ['index', 'groupInfo']]);

        $this->groups = $groups;
    }

    // Lista los últimos grupos
    public function index(Request $request)
    {

        $groupList = Disc::all();

        return view('groups.index', [
            'groups' => $groupList,
        ]);
    }

    public function groupInfo(Request $request, $id)
    {
        $group = Group::find($id)->get();

        return view('groups.info', [
            'group' => $group,
        ]);
    }


    // Funciónes de administración de grupos.
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255',
    		]);

    	$request->user()->groups()->create([
    		'name' => $request->name,
    		]);

    	return redirect('/groups');
    }

    public function destroy(Request $request, Group $group)
    {
        $this->authorize('destroy', $group);

        $group->delete();

        return redirect('/groups');
    }

}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Group, Management };
use App\Http\Requests\{CreateGroupRequest};

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::query()
                ->onlyTrashedIf($request->routeIs('groups.trash'))
                ->orderBy('id')
                ->paginate(20);
        
        return view('group.groups',[
            'module'    => 'group',
            'view'      => $request->routeIs('groups.trash') ? 'trash' : 'index',
            'groups'    => $groups,
            // 'coordinations'   => Coordination::where('active', true)->get(),
            ]);
        
    }

    // public function create()
    // {
    //     $coordination = new Coordination;

    //     return view('coordination.create', [
    //         'module' => 'coordination',
    //         'view' => 'create',
    //         'coordination' => $coordination,
    //         'managements'   => Management::where('active', true)->get(),
    //         ]);
    // }

    public function store(CreateGroupRequest $request)
    {
        $request->createGroup();
        
        return redirect()->route('groups');
    }

    // public function edit(Coordination $coordination)
    // {
    //     return view('coordination.edit', [
    //         'module'        => 'coordination',
    //         'view'          => 'edit',
    //         'coordination'  => $coordination,
    //         'managements'   => Management::where('active', true)->get(),
    //         ]);
    // }
    
    // public function update(UpdateCoordinationRequest $request, Coordination $coordination)
    // {
    //     $request->updateCoordination($coordination);
        
    //     return redirect()->route('coordinations'); ;
    // }

    public function trash(Group $group)
    {
        $group->delete();
        return redirect()->route('groups');
    }

    public function restore($id)
    {
        $group = Group::onlyTrashed()->where('id', $id)->firstOrFail();
        $group->restore();
        return redirect()->route('groups.trash');
    }

    public function destroy($id)
    {
        $group = Group::onlyTrashed()->where('id', $id)->firstOrFail();
        $group->forceDelete();
        return redirect()->route('groups.trash');
    }

}

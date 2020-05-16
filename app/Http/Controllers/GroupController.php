<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Group, Coordination };
use App\Http\Requests\{CreateGroupRequest, UpdateGroupRequest};

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $groups = Group::query()
                ->onlyTrashedIf($request->routeIs('groups.trash'))
                ->with('coordination')
                ->orderBy('coordination_id')
                ->paginate(20);
        
        return view('group.groups',[
            'module'    => 'group',
            'view'      => $request->routeIs('groups.trash') ? 'trash' : 'index',
            'groups'    => $groups,
            ]);
        
    }

    public function create()
    {
        $group = new Group;

        return view('group.create', [
            'module'    => 'group',
            'view'      => 'create',
            'group'     => $group,
            'coordinations'   => Coordination::where('active', true)->get(),
            ]);
    }

    public function store(CreateGroupRequest $request)
    {
        $request->createGroup();
        
        return redirect()->route('groups');
    }

    public function edit(Group $group)
    {
        return view('group.edit', [
            'module'    => 'group',
            'view'      => 'edit',
            'group'     => $group,
            'coordinations'   => Coordination::where('active', true)->get(),
            ]);
    }
    
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $request->updateGroup($group);
        
        return redirect()->route('groups'); ;
    }

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

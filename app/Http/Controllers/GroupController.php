<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Group, Management };
// use App\Http\Requests\{CreateCoordinationRequest, UpdateCoordinationRequest};

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

    // public function store(CreateCoordinationRequest $request)
    // {
    //     $request->createCoordination();
        
    //     return redirect()->route('coordinations');
    // }

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

    // public function trash(Coordination $coordination)
    // {
    //     $coordination->active = false;
    //     $coordination->save();
    //     $coordination->delete();
    //     return redirect()->route('coordinations');
    // }

    // public function restore($id)
    // {
    //     $coordination = Coordination::onlyTrashed()->where('id', $id)->firstOrFail();
    //     $coordination->restore();
    //     return redirect()->route('coordinations.trash');
    // }

    // public function destroy($id)
    // {
    //     $coordination = Coordination::onlyTrashed()->where('id', $id)->firstOrFail();
    //     $coordination->forceDelete();
    //     return redirect()->route('coordinations.trash');
    // }

}

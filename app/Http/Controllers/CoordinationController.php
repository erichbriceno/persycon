<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Coordination, Management };
use App\Http\Requests\{CreateCoordinationRequest, UpdateProjectRequest};

class CoordinationController extends Controller
{
    public function index(Request $request)
    {
        $coordinations = Coordination::query()
                ->onlyTrashedIf($request->routeIs('coordinations.trash'))
                ->orderBy('id')
                ->paginate(20);
        
        return view('coordination.coordinations',[
        'module' => 'coordination',
        'view' => $request->routeIs('coordinations.trash') ? 'trash' : 'index',
        'coordinations' => $coordinations,
        'managements'   => Management::where('active', true)->get(),
        ]);
    }

    public function create()
    {
        $coordination = new Coordination;

        return view('coordination.create', [
            'module' => 'coordination',
            'view' => 'create',
            'coordination' => $coordination,
            'managements'   => Management::where('active', true)->get(),
            ]);
    }

    public function store(CreateCoordinationRequest $request)
    {
        $request->createCoordination();
        
        return redirect()->route('coordinations');
    }
    
    public function trash(Coordination $coordination)
    {
        $coordination->active = false;
        $coordination->save();
        $coordination->delete();
        return redirect()->route('coordinations');
    }

    public function restore($id)
    {
        $coordination = Coordination::onlyTrashed()->where('id', $id)->firstOrFail();
        $coordination->restore();
        return redirect()->route('coordinations.trash');
    }

    public function destroy($id)
    {
        $coordination = Coordination::onlyTrashed()->where('id', $id)->firstOrFail();
        $coordination->forceDelete();
        return redirect()->route('coordinations.trash');
    }

}

<?php

namespace App\Http\Controllers;

use App\Model\Management;
use Illuminate\Http\Request;
use App\Http\Requests\{ CreateManagementRequest, UpdateManagementRequest};

class ManagementController extends Controller
{
    
    public function index(Request $request)
    {
        $managements = Management::query()
            ->onlyTrashedIf($request->routeIs('managements.trash'))
            ->orderBy('id')
            ->paginate(20);
        
        return view('management.managements', [
            'module' => 'management',            
            'view' => $request->routeIs('managements.trash') ? 'trash' : 'index',
            'managements' => $managements,
        ]);
    }

    public function trash(Management $management)
    {
        $management->active = false;
        $management->save();
        $management->delete();

        return redirect()->route('managements');
    }

    public function restore($id)
    {
        $management = Management::onlyTrashed()->where('id', $id)->firstOrFail();
        $management->save();
        $management->restore();

        return redirect()->route('managements.trash');
    }

    public function destroy($id)
    {
        $management = Management::onlyTrashed()->where('id', $id)->firstOrFail();
        $management->forceDelete();
        return redirect()->route('managements.trash');
    }

    public function create()
    {
        $management = new Management;

        return view('management.create', [
            'module'    => 'management',
            'view'      => 'create',
            'management'=> $management,
            ]);
    }

    public function store(CreateManagementRequest $request)
    {
        $request->createManagement();

        return redirect()->route('managements');
    }

    public function edit(Management $management)
    {
        return view('management.edit', [
            'module' => 'management',
            'view' => 'edit',
            'management' => $management,
            ]);
    }

    public function update(UpdateManagementRequest $request, Management $management)
    {
        $request->updateManagement($management);
        
        return redirect()->route('managements'); ;
    }
}

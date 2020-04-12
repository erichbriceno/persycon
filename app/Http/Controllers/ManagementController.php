<?php

namespace App\Http\Controllers;

use App\Model\Management;
use Illuminate\Http\Request;

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
        $management->selectable = false;
        $management->save();
        $management->delete();

        return redirect()->route('managements');
    }

    public function restore($id)
    {
        $management = Management::onlyTrashed()->where('id', $id)->firstOrFail();
        $management->selectable = true;
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
}

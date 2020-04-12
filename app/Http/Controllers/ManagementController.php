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
}

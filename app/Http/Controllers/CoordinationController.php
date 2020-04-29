<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Coordination, Management };

class CoordinationController extends Controller
{
    public function index()
    {
        return view('coordination.coordinations',[
        'module' => 'coordination',
        'view' => 'index',
        'coordinations' => Coordination::paginate(20),
        'managements'   => Management::where('selectable', true)->get(),
        ]);
    }
}

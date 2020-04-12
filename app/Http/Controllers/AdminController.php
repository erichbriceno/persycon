<?php

namespace App\Http\Controllers;


use App\Model\{ Group, Coordination };

class AdminController extends Controller
{
    public function group()
    {
        return view('admin.groups',[
        'module' => 'admin',
        'view' => 'groups',
        'groups' => Group::paginate(20),
        ]);
    }

    public function coordination()
    {
        return view('admin.coordinations',[
        'module' => 'admin',
        'view' => 'coordinations',
        'coordinations' => Coordination::paginate(20),
        ]);
    }

}

<?php

namespace App\Http\Controllers;


use App\Model\{ Group, Management };

class AdminController extends Controller
{
            
    public function management()
    {
        return view('admin.management', [
            'module' => 'admin',            
            'view' => 'managements',
            'managements' => Management::paginate(20),
        ]);
    }

    public function group()
    {
        return view('admin.groups',[
        'module' => 'admin',
        'view' => 'groups',
        'groups' => Group::paginate(20),
        ]);
    }

}

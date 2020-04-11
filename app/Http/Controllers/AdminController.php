<?php

namespace App\Http\Controllers;


use App\Model\{ Group, Management };

class AdminController extends Controller
{
            
    public function management()
    {
        return view('managements.management', [
            'module' => 'management',            
            'view' => 'index',
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

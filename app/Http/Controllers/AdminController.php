<?php

namespace App\Http\Controllers;


use App\Model\{ Group};

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

}

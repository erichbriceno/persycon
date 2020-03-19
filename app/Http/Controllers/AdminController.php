<?php

namespace App\Http\Controllers;


use App\Model\{ Group, Project, Management };

class AdminController extends Controller
{
    public function project()
    {
        return view('project.project', [
        'view' => 'projects',
        'projects' => Project::paginate(20),
        ]);
    }

    public function management()
    {
        return view('admin.management', [
            'view' => 'managements',
            'managements' => Management::paginate(20),
        ]);
    }

    public function group()
    {
        return view('admin.groups',[
        'view' => 'groups',
        'groups' => Group::paginate(20),
        ]);
    }

}

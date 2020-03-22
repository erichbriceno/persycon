<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Project };


class ProjectController extends Controller
{
 
    public function index()
    {
        return view('project.projects', [
        'module' => 'project',
        'view' => 'index',
        'projects' => Project::paginate(20),
        ]);
    }

    public function create()
    {
        return view('project.create', [
            'module' => 'project',
            'view' => 'create',
            ]);
    }

}

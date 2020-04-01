<?php

namespace App\Http\Controllers;

use App\Model\{ Project };
use App\Http\Requests\CreateProjectRequest;


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
            'years' => [
                today()->sub('1 year')->format('Y'),
                today()->format('Y'),
                today()->add('1 year')->format('Y'),
                ]
            ]);
    }

    public function store(CreateProjectRequest $request)
    {
        $request->createProject();

        return redirect()->route('projects');
    }
    
}

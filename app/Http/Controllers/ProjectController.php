<?php

namespace App\Http\Controllers;

use App\Model\{ Project };
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

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
        $project = new Project;

        return view('project.create', [
            'module' => 'project',
            'view' => 'create',
            'project' => $project,
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

    public function edit(Project $project)
    {
        return view('project.edit', [
            'module' => 'project',
            'view' => 'edit',
            'project' => $project,
            'years' => [
                today()->sub('1 year')->format('Y'),
                today()->format('Y'),
                today()->add('1 year')->format('Y'),
                ]
            ]);
    }
    
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $request->updateProject($project);

        return redirect()->route('projects'); ;
    }
}

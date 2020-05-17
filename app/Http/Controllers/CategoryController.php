<?php

namespace App\Http\Controllers;

use App\Model\Project;
use Illuminate\Http\Request;
// use App\Http\Requests\{CreateProjectRequest, UpdateProjectRequest};


class CategoryController extends Controller
{
 
    public function index(Request $request)
    {
        $projects = Project::query()
                ->with('categories')
                ->orderBy('id')
                ->paginate(20);
        
        return view('category.categories', [
            'module'    => 'category',
            'view'      => 'index',
            'projects'  => $projects,
        ]);
    }

    public function edit(Project $project, Request $request )
    {
        return view('category.edit', [
            'module'    => 'category',
            'view'      => 'edit',
            'project'   => $project,
            ]);
    }


    // public function create()
    // {
    //     $project = new Project;

    //     return view('project.create', [
    //         'module' => 'project',
    //         'view' => 'create',
    //         'project' => $project,
    //         'years' => [
    //             today()->sub('1 year')->format('Y'),
    //             today()->format('Y'),
    //             today()->add('1 year')->format('Y'),
    //             ]
    //         ]);
    // }

    // public function store(CreateProjectRequest $request)
    // {
    //     $request->createProject();

    //     return redirect()->route('projects');
    // }


    
    // public function update(UpdateProjectRequest $request, Project $project)
    // {
    //     $request->updateProject($project);
        
    //     return redirect()->route('projects'); ;
    // }

    // public function trash(Project $project)
    // {
    //     $project->active = false;
    //     $project->save();
    //     $project->delete();
    //     return redirect()->route('projects');
    // }

    // public function restore($id)
    // {
    //     $project = Project::onlyTrashed()->where('id', $id)->firstOrFail();
    //     $project->restore();
    //     return redirect()->route('projects.trash');
    // }

    // public function destroy($id)
    // {
    //     $project = Project::onlyTrashed()->where('id', $id)->firstOrFail();
    //     $project->forceDelete();
    //     return redirect()->route('projects.trash');
    // }
}

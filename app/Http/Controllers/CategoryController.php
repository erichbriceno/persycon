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

    public function edit(Project $project)
    {
        return view('category.edit', [
            'module'    => 'category',
            'view'      => 'edit',
            'project'   => $project,
            ]);
    }

//    public function update(UpdateProjectRequest $request, Project $project)
    public function update(Request $request, Project $project)
    {
        //$request->updateProject($project);

        $project->cat1min = $request->category1_min;
        $project->cat1max = $request->category1_max;
        $project->cat2min = $request->category2_min;
        $project->cat2max = $request->category2_max;
        $project->cat3min = $request->category3_min;
        $project->cat3max = $request->category3_max;
        $project->cat4min = $request->category4_min;
        $project->cat4max = $request->category4_max;

        $project->push();

        return redirect()->route('categories'); ;
    }
}

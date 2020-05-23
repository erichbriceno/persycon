<?php

namespace App\Http\Controllers;

use App\Model\Project;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\{UpdateCategoryRequest};


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
        // $url = url()->previous();
        // dd(Str::contains(url()->previous(),'projects'));

        return view('category.edit', [
            'module'    => 'category',
            'view'      => 'edit',
            'project'   => $project,
            'back'      => Str::contains(url()->previous(),'projects') ? 'projects' : 'categories'
            ]);
    }

   public function update(UpdateCategoryRequest $request, Project $project)
    {
        $request->updateCategoriesProject($project);

        return redirect()->route('categories'); ;
    }
}

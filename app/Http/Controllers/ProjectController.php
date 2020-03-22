<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\{ Project };


class ProjectController extends Controller
{
 
    public function project()
        {
            return view('project.project', [
            'view' => 'projects',
            'projects' => Project::paginate(20),
            ]);
        }


}

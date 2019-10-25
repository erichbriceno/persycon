<?php

namespace App\Http\Controllers;


use Illuminate\Validation\Rule;
use App\Http\Requests\CreateUserRequest;
use App\Model\{ User, Role, Group, Project, Management };

class AdminController extends Controller
{
    public function project()
    {
        $title ='LISTADO DE PROYECTOS';
        $projects = Project::paginate(20);

        return view('admin.project', compact('title','projects'));
    }

    public function management()
    {
        $title = 'LISTADO DE GERENCIAS';
        $managements = Management::paginate(20);

        return view('admin.management', compact('title','managements'));
    }

    public function group()
    {
        $title = 'LISTADO DE GRUPOS';
        $groups = Group::paginate(20);

        return view('admin.groups', compact('title','groups'));
    }

}

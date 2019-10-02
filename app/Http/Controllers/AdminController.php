<?php

namespace App\Http\Controllers;


use App\Model\Group;
use App\Model\Management;
use App\Model\Project;
use App\Model\User;

class AdminController extends Controller
{
    public function project()
    {
        $title ='LISTADO DE PROYECTOS';
        $projects = Project::paginate(10);

        return view('admin.project', compact('title','projects'));
    }

    public function management()
    {
        $title = 'LISTADO DE GERENCIAS';
        $managements = Management::paginate(10);

        return view('admin.management', compact('title','managements'));
    }

    public function group()
    {
        $title = 'LISTADO DE GRUPOS';
        $groups = Group::paginate(10);

        return view('admin.groups', compact('title','groups'));
    }

    public function user()
    {
        $title = 'LISTADO DE USUARIOS';
        $users = User::paginate(10);

        return view('user.users', compact('title','users'));
    }

    public function userDetails(User $user)
    {
        $title = 'DETALLES DEL USUARIO';
        return view('user.details', compact('title','user'));
    }

    public function create()
    {
        $title = 'CREAR USUARIO';
        return view('user.create', compact('title'));
    }

    public function store()
    {
        return "Grabando";
    }
}

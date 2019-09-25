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
        $projects = Project::paginate(10);

        return view('admin.project', compact('projects'));
    }

    public function management()
    {
        $managements = Management::paginate(10);

        return view('admin.management', compact('managements'));
    }

    public function group()
    {
        $groups = Group::paginate(10);

        return view('admin.groups', compact('groups'));
    }

    public function user()
    {
        $users = User::paginate(10);

        return view('user.users', compact('users'));
    }

    public function userDetails(User $user)
    {
        return view('user.details', compact('user'));
    }

    public function create()
    {
        return view('user.create');
    }

    public function store()
    {
        return "Grabando";
    }
}

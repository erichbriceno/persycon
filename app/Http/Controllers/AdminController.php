<?php

namespace App\Http\Controllers;


use App\Http\Requests\CreateUserRequest;
use App\Model\User;
use App\Model\Group;
use App\Model\Project;
use App\Model\Management;
use Illuminate\Validation\Rule;

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

    public function details(User $user)
    {
        $title = 'DETALLES DEL USUARIO';
        return view('user.details', compact('title','user'));
    }

    public function create()
    {
        $title = 'REGISTRAR USUARIO';
        return view('user.create', compact('title'));
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $title = 'EDITAR USUARIO';
        return view('user.edit', compact('title','user'));
    }

    public function update(User $user)
    {
        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
            'role' => 'required',
            'password' => '',
        ]);

        if ($data['password'] != null) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()->route('user.details', $user);
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }

}

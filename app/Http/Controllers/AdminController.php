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

    public function user()
    {
        $title = 'LISTADO DE USUARIOS';
        $users = User::paginate(15);

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
        $roles = Role::orderBy('description', 'DESC')->get();

        return view('user.create', compact('title', 'roles'));
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $title = 'EDITAR USUARIO';
        $roles = Role::orderBy('description', 'DESC')->get();

        return view('user.edit', compact('title','user', 'roles'));
    }

    public function update(User $user)
    {

        $data = request()->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => '',
            'role_id' => [
                'required',
                'present',
                Rule::exists('roles', 'id')->where('selectable', true),
            ]
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

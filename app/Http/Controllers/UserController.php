<?php

namespace App\Http\Controllers;


use App\Http\Requests\UpdateUserRequest;
use App\Model\{Management, User, Role};
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{

    public function index()
    {
        $users = User::query()
            ->with('role', 'management')
            ->byManagement(request('management'))
            ->byState(request('state'))
            //->byRole(request('role'))
            ->search(request('search'))
            ->orderBy('id')
            ->paginate();

        $users->appends(request(['search', 'management', 'state']));

        return view('user.users', [
            'users' => $users,
            'title'  => 'LISTADO DE USUARIOS',
            'emptyMessage' => 'There are no registered users',
            'roles' => Role::all(),
            'managements' => Management::all(),
            'states' => trans('users.filters.states'),
            'checkedRoles' => collect(request('roles')),
        ]);
    }

    public function trashed()
    {
        $title = 'PAPELERA DE USUARIOS';
        $emptyMessage = 'There are no users deleted';
        $users = User::onlyTrashed()
            ->with('role', 'management')
            ->paginate(15);

        return view('user.users', compact('title','users', 'emptyMessage'));
    }

    public function details(User $user)
    {
        $title = 'DETALLES DEL USUARIO';

        return view('user.details', compact('title', 'user'));
    }

    public function create()
    {
        $title = 'REGISTRAR USUARIO';
        $user = New User;
        $managements = Management::all(); //Debo incluir el valor null o vacio
        $roles = Role::orderBy('description', 'DESC')->get();

        return view('user.create', compact('title', 'roles', 'user', 'managements'));
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        $title = 'EDITAR USUARIO';
        $managements = Management::all();
        $roles = Role::orderBy('description', 'DESC')->get();

        return view('user.edit', compact('title', 'roles', 'user', 'managements'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $request->updateUser($user);

        return redirect()->route('user.details', $user);
    }

    public function trash(User $user)
    {
        $user->delete();

        return redirect()->route('users');
    }

    public function restore($id)
    {

        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();

        $user->deleted_at = null;

        $user->update();

        return redirect()->route('users.trash');
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();

        $user->forceDelete();

        return redirect()->route('users.trash');
    }

}

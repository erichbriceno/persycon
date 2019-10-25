<?php

namespace App\Http\Controllers;


use App\Model\{ User, Role };
use Illuminate\Validation\Rule;
use App\Http\Requests\CreateUserRequest;

class UserController extends Controller
{

    public function index()
    {
        $title = 'LISTADO DE USUARIOS';
        $emptyMessage = 'There are no registered users';

        $users = User::query()
            ->when(request('search'), function ($query, $search) {
                $query->where('name', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%");
            })
            ->orderBy('role_id')
            ->paginate();

        return view('user.users', compact('title','users', 'emptyMessage'));
    }

    public function trashed()
    {
        $title = 'PAPELERA DE USUARIOS';
        $emptyMessage = 'There are no users deleted';
        $users = User::onlyTrashed()->paginate(15);

        return view('user.users', compact('title','users', 'emptyMessage'));
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

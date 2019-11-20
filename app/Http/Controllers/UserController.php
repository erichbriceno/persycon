<?php

namespace App\Http\Controllers;


use App\Sortable;
use Illuminate\Http\Request;
use App\Model\{Management, User, Role};
use App\Http\Requests\{CreateUserRequest, UpdateUserRequest};

class UserController extends Controller
{

    public function index(Request $request, Sortable $sortable)
    {

        $users = User::query()
            ->when($request->routeIs('users.trash'), function ($q) {
                $q->onlyTrashed();
            })
            ->with('role', 'management')
            ->filterBy($request->only(['search', 'management', 'state', 'roles', 'from', 'to' ]))
            ->when(request('order'), function ($q) {
                $q->orderBy(request('order'), request('direction', 'asc' ));
            }, function ($q) {
                $q->orderBy('id');
            })
            ->paginate();

        $users->appends($request->only(['search', 'management', 'state', 'roles', 'from', 'to' ]));

        $sortable->setCurrentOrder(request('order'), request('direction'));

        return view('user.users', [
            'view' => $request->routeIs('users.trash') ? 'trash' : 'index',
            'users' => $users,
            'roles' => Role::all(),
            'managements' => Management::where('selectable', true)->get(),
            'checkedRoles' => collect(request('roles')),
            'sortable' => $sortable
        ]);
    }

    public function details(User $user)
    {
        return view('user.details',[
            'view' => 'details',
            'user' => $user
        ]);
    }

    public function create()
    {
        return view('user.create', [
            'view' => 'create',
            'user' =>  New User,
            'roles' => Role::orderBy('description', 'DESC')->get(),
            'managements' => Management::where('selectable', true)->get(),
        ]);
    }

    public function store(CreateUserRequest $request)
    {
        $request->createUser();

        return redirect()->route('users');
    }

    public function edit(User $user)
    {
        return view('user.edit', [
            'view' => 'edit',
            'user' => $user,
            'roles' => Role::orderBy('description', 'DESC')->get(),
            'managements' => Management::where('selectable', true)->get(),
        ]);
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

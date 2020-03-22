<?php

namespace App\Http\Controllers;


use App\Rules\ValidCedule;
use App\Utils\Sortable;
use Illuminate\Support\Str;
use App\Queries\UserFilter;
use Illuminate\Http\Request;
use App\Model\{Cedulate, Management, User, Role};
use App\Http\Requests\{CreateUserRequest, FindCitizenRequest, UpdateUserRequest};

class UserController extends Controller
{

    public function index(Request $request, UserFilter $filters, Sortable $sortable)
    {

        $users = User::query()

            ->with('role', 'management')
            ->withLastLogin()
            ->onlyTrashedIf($request->routeIs('users.trash'))
            ->filterBy($filters, $request->only(['search', 'management', 'state', 'roles', 'from', 'to', 'order', 'direction']))
            ->orderBy('id')
            ->paginate();

        $users->appends($filters->valid());
        $sortable->appends($filters->valid());

        return view('user.users', [
            'module' => 'user',
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
            'module' => 'user',
            'view' => 'details',
            'user' => $user
        ]);
    }

    public function find()
    {
        return view('user.create', [
            'module' => 'user',
            'view' => 'create',
            'user' =>  new User,
            'roles' => Role::orderBy('description', 'DESC')->get(),
            'managements' => Management::where('selectable', true)->get(),
        ]);
    }

    public function finder(FindCitizenRequest $request)
    {
        return redirect()->route('user.create',$request->cedule);
    }
    public function create($cedule = null)
    {
        $validate = new ValidCedule;

        if(! $validate->passes('cedule', $cedule)) {
            return redirect()->route('user.find');
        }

        $user = new User;

        $cedulate = Cedulate::where('letra', Str::substr($cedule, 0, 1))
            ->where('numerocedula', (int) Str::substr($cedule, 1, 8))
            ->first();

        $user->nat = $cedulate->letra;
        $user->numberced  = $cedulate->numerocedula;
        $user->names = "$cedulate->primernombre $cedulate->segundonombre";
        $user->surnames = "$cedulate->primerapellido $cedulate->segundoapellido";

        return view('user.create', [
            'module' => 'user',
            'view' => 'create',
            'user' =>  $user,
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
            'module' => 'user',
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

        $user->restore();

        return redirect()->route('users.trash');
    }

    public function destroy($id)
    {
        $user = User::onlyTrashed()->where('id', $id)->firstOrFail();

        $user->forceDelete();

        return redirect()->route('users.trash');
    }

}

<?php

namespace App\Http\Controllers;

use App\Model\{People};
use App\Queries\PersonFilter;
use Illuminate\Http\Request;

class PeopleController extends Controller
{
    public function index(Request $request, PersonFilter $filters)
    {

        // $users = User::query()
        //         ->with('role', 'management')
        //         ->withLastLogin()
        //         ->onlyTrashedIf($request->routeIs('users.trash'))
        //         ->filterBy($filters, $request->only(['search', 'management', 'state', 'roles', 'from', 'to', 'order', 'direction']))
        //         ->orderBy('id')
        //         ->paginate();

        // $users->appends($filters->valid());
        // $sortable->appends($filters->valid());

        // return view('user.users', [
        //     'module' => 'user',
        //     'view' => $request->routeIs('users.trash') ? 'trash' : 'index',
        //     'users' => $users,
        //     'roles' => Role::all(),
        //     'managements' => Management::all(),
        //     'checkedRoles' => collect(request('roles')),
        //     'sortable' => $sortable
        // ]);
        
        $people = People::query()
                ->onlyTrashedIf($request->routeIs('people.trash'))
                ->filterBy($filters, $request->only(['order', 'direction']))
                ->orderBy('id')
                ->paginate();

        return view('people.list', [
            'module' => 'people',
            'view' => $request->routeIs('people.blacklist') ? 'blacklist' : 'index',
            'people' => $people,
        ]);
    }
}

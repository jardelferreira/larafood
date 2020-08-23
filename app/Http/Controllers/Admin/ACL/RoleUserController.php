<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleUserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['can:users']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function users(Role $role)
    {
        return view('Admin.Pages.Roles.Users.index', [
            'users' => $role->users(),
            'role' => $role
        ]);
    }


    public function roles(User $user)
    {

        if (!$user) {
            return redirect()->back()->with('error', 'Regra inexistente!');
        }
        return view('Admin.Pages.Users.Roles.index', [
            'roles' => $user->roles()->paginate(),
            'user' => $user
        ]);
    }

    public function search(User $user, Request $request)
    {
        return view('Admin.Pages.Roles.Users.index', [
            'user' => $user->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }

    public function rolesUsersCreate(User $user, Request $request)
    {
        if (!$user) {
            return redirect()->back()->with('error', 'Regras inexistente!');
        }
        $filters = $request->except('_token');
        return view('Admin.Pages.Users.Roles.create', [
            'roles' => $user->rolesAvailable($request->filter),
            'user' => $user,
            'filters' => $filters
        ]);
    }

    public function rolesUsersStore(Request $request, User $user)
    {
        if (!$user) {
            return redirect()->back()->with('error', 'Regras inexistente!');
        }
        if (!$request->roles || count($request->roles) < 1) {
            return redirect()->back()->with('info', 'Selecione uma permissão!');
        }
        $user->roles()->attach($request->roles);
        return redirect()->route('users.roles', $user->id);
    }

    public function rolesUsersDestroy(User $user, Role $role)
    {
        if (!$user || !$role) {
            return redirect()->back()->with('error', 'Regras inexistente!');
        }
        $user->roles()->detach($role);

        return redirect()->route('users.roles', $user->id);
    }
}

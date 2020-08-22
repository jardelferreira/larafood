<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\RoleRequest;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    public function __construct()       
    {
        $this->middleware(['can:roles']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $roles)
    {
        return view('Admin.Pages.Roles.index',[
            'roles' => $roles->latest()->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request, Role $role)
    {
        $role->create($request->all());
        return redirect()->route('roles.index')->with('message', 'Regra criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('Admin.Pages.Roles.show',[
            'role' => $role
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleRequest $request, Role $role)
    {
        if (!$role) {
            return redirect()->back()->with('error','Regra inexistente!');
        }
        $role->update($request->all());
        return redirect()->route('roles.index')->with('message', 'Regra Alterado com successo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\RoleRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('Admin.Pages.Roles.edit',[
            'role' => $role
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        if (!$role) {
            return redirect()->back()->with('error','Regra inexistente!');
        }
        $role->delete();
        return redirect()->route('roles.index')->with('message', 'Regra deletado com successo');
    }
    
    public function search(Role $role, RoleRequest $request)
    {
        return view('Admin.Pages.Roles.index', [
            'roles' => $role->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }

    public function permissions(Role $role)
    {
 
        if (!$role) {
            return redirect()->back()->with('error','Regra inexistente!');
        }
        return view('Admin.Pages.Roles.Permissions.index',[
            'permissions' => $role->permissions()->paginate(),
            'role' => $role
        ]);
    }

    public function rolesPermissionsCreate(Role $role,Request $request)
    {
        if (!$role) {
            return redirect()->back()->with('error','Regras inexistente!');
        }
        $filters = $request->except('_token');
        return view('Admin.Pages.Roles.Permissions.create',[
            'permissions' => $role->permissionsAvailable($request->filter),
            'role' => $role,
            'filters' => $filters
        ]);
    }

    public function rolesPermissionsStore(Request $request, Role $role)
    {
        if (!$role) {
            return redirect()->back()->with('error','Regras inexistente!');
        }
        if (!$request->permissions || count($request->permissions) < 1) {
            return redirect()->back()->with('info','Selecione uma permissão!');
        }
        $role->permissions()->attach($request->permissions);
        return redirect()->route('roles.permissions',$role->id);
    }

    public function rolesPermissionsDestroy(Role $role,Permission $permission)
    {
        if (!$role || !$permission) {
            return redirect()->back()->with('error','Regras inexistente!');
        }
        $role->permissions()->detach($permission);

        return redirect()->route('roles.permissions',$role->id);
    }


}

<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PermissionRequest;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Permission $permissions)
    {
        return view('Admin.Pages.Permissions.index',[
            'permissions' => $permissions->latest()->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Permissions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionRequest $request, Permission $permission)
    {
        $permission->create($request->all());
        return redirect()->route('permissions.index')->with('message', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return view('Admin.Pages.Permissions.show',[
            'permission' => $permission
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionRequest $request, Permission $permission)
    {
        if (!$permission) {
            return redirect()->back()->with('error','Permissão inexistente!');
        }
        $permission->update($request->all());
        return redirect()->route('permissions.index')->with('message', 'Permissão Alterado com successo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        return view('Admin.Pages.Permissions.edit',[
            'permission' => $permission
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        if (!$permission) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $permission->delete();
        return redirect()->route('permissions.index')->with('message', 'Perfil deletado com successo');
    }
    
    public function search(Permission $permission, Request $request)
    {
        return view('Admin.Pages.Permissions.index', [
            'permissions' => $permission->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
    
    public function profiles(Permission $permission)
    {
        if (!$permission) {
            return redirect()->back()->with('error','Permissão não existe!');
        }
        return view('Admin.Pages.Permissions.Profiles.index',[
            'permission' => $permission,
            'profiles' => $permission->profiles()->paginate()
        ]);
    }
}

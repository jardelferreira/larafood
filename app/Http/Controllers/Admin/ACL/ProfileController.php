<?php

namespace App\Http\Controllers\Admin\ACL;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Models\Permission;
use App\Models\Profile;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Profile $profiles)
    {
        return view('Admin.Pages.Profiles.index',[
            'profiles' => $profiles->latest()->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Profiles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, Profile $profile)
    {
        $profile->create($request->all());
        return redirect()->route('profiles.index')->with('message', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        return view('Admin.Pages.Profiles.show',[
            'profile' => $profile
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProfileRequest $request, Profile $profile)
    {
        if (!$profile) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $profile->update($request->all());
        return redirect()->route('profiles.index')->with('message', 'Perfil Alterado com successo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        return view('Admin.Pages.Profiles.edit',[
            'profile' => $profile
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        if (!$profile) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $profile->delete();
        return redirect()->route('profiles.index')->with('message', 'Perfil deletado com successo');
    }
    
    public function search(Profile $profile, Request $request)
    {
        return view('Admin.Pages.Profiles.index', [
            'profiles' => $profile->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }

    public function permissions(Profile $profile)
    {
        if (!$profile) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        return view('Admin.Pages.Profiles.Permissions.index',[
            'permissions' => $profile->permissions()->paginate(),
            'profile' => $profile
        ]);
    }

    public function permissionsCreate(Profile $profile,Permission $permisson)
    {
        if (!$profile) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        return view('Admin.Pages.Profiles.Permissions.create',[
            'permissions' => $profile->permissionsAvailable(),
            'profile' => $profile
        ]);
    }

    public function permissionProfileStore(Request $request, Profile $profile)
    {
        if (!$profile) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        if (!$request->permissions || count($request->permissions) < 1) {
            return redirect()->back()->with('info','Selecione uma permissão!');
        }
        $profile->permissions()->attach($request->permissions);
        return redirect()->route('profiles.permissions',$profile->id);
    }
}

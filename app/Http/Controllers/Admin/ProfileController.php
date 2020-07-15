<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
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
}
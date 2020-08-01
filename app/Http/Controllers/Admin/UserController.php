<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $users)
    {
        return view('Admin.Pages.Users.index',[
            'users' => $users->latest()->TenantUser()->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request, User $user)
    {
        $request['tenant_id'] = auth()->user()->tenant_id;
        $request['password'] = bcrypt($request['password']);
        $user->create($request->all());
        return redirect()->route('users.index')->with('message', 'Perfil criado com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $usuario = new User();
        
        return view('Admin.Pages.Users.show',[
            'user' => $usuario->TenantUser()->find($user->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if (!$user) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $user->update($request->only(['name','email']));
        return redirect()->route('users.index')->with('message', 'Perfil Alterado com successo');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $usuario = new User();
        return view('Admin.Pages.Users.edit',[
            'user' => $usuario->TenantUser()->find($user->id)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (!$user) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $user->delete();
        return redirect()->route('users.index')->with('message', 'Perfil deletado com successo');
    }
    
    public function search(User $user, Request $request)
    {
        return view('Admin.Pages.Users.index', [
            'users' => $user->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
} 

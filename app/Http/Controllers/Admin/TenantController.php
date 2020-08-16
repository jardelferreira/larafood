<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TenantRequest;
use Illuminate\Support\Facades\Storage;

class TenantController extends Controller
{
    public function __construct()       
    {
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tenant $tenants)
    {
        return view('Admin.Pages.Tenants.index',[
            'tenants' => $tenants->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plans)
    {
        return view('Admin.Pages.Tenants.create',[
            'plans' => $plans->all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TenantRequest $request, Tenant $tenant)
    {
        $data = $request->all();
        if ($request->hasFile('logo') && $request->logo->isValid()) {
          $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/imgs");
        }
        $tenant->create($data);
        return redirect()->route('tenants.index')->with('message','Empresa Cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Tenant $tenant)
    {
        return view('Admin.Pages.Tenants.show',[
            'tenant' => $tenant,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Tenant $tenant, Plan $plans)
    {
        if (!$tenant) {
            return redirect()->back()->with('error',"Empresa não encontrada!");
        }
        return view('Admin.Pages.Tenants.edit',[
            'tenant' => $tenant,
            'plans' => $plans->all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TenantRequest $request, Tenant $tenant)
    {
        if (!$tenant) {
            return redirect()->back()->with('error',"Empresa não encontrada!");
        }
    
        $data = $request->all();
        if ($request->hasFile('logo') && $request->logo->isValid()) {
            if (Storage::exists($tenant->logo)) {
                Storage::delete($tenant->logo);
            }
          $data['logo'] = $request->logo->store("tenants/{$tenant->uuid}/tenants");
        }
        $tenant->update($data);
        return redirect()->route('tenants.index')->with('message',"Empresa atualizada com sucesso!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tenant $tenant)
    {
        if (!$tenant) {
            return redirect()->back()->with('error',"Empresa não encontrada!");
        }
        if (Storage::exists($tenant->image)) {
            Storage::delete($tenant->image);
        }
        $tenant->delete();
        return redirect()->route('tenants.index')->with('message',"Empresa removida com sucesso!");
    }

    public function search(Tenant $tenant,Request $request)
    {
        return view('Admin.Pages.Tenants.index', [
            'tenants' => $tenant->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
}

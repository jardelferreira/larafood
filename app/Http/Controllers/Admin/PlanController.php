<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\PlanRequest;
use App\Http\Controllers\Controller;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = new Plan();
        return view('Admin.Pages.Plans.index', [
            'plans' => $plans->latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Plans.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanRequest $request,Plan $plan)
    {
        $plan->create($request->all());
        return redirect()->route('plans.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan)
    {
        return view('Admin.Pages.Plans.show',[
            'plan' => $plan
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return  view('Admin.Pages.Plans.edit',[
            'plan' => $plan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanRequest $request, Plan $plan)
    {
        if (!$plan) {
            return redirect()->back();
        }
        $plan->update($request->all());
        return redirect()->route('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan)
    {
        if(!$plan){
            return redirect()->back()->withErrors('message', 'Não foi possivel deltar este plano');
        }
        if(!$plan->details()->count()){
            $plan->delete();
            return redirect()->route('plans.index')->with('message','Plano deletado com sucesso');
        }else{
            return redirect()->back()->with('error','Não foi possível deletar este plano, existem detalhes vinculados a este plano');
        }
    }

    public function search(Request $request, Plan $plan)
    {
        return view('Admin.Pages.Plans.index', [
            'plans' => $plan->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
}

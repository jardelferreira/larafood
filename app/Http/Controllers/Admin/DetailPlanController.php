<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\DetailPlanRequest;
use App\Models\DetailPlan;
use App\Models\Plan;
use Illuminate\Http\Request;

class DetailPlanController extends Controller
{
    public function __construct()       
    {
        $this->middleware(['can:plans']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Plan $plan)
    {
        if (!$plan) {
            return redirect()->back();
        }
        return view('Admin.Pages.Plans.Details.index',[
            'plan' => $plan,
            'details' => $plan->details()->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Plan $plan)
    {
        return view('Admin.Pages.Plans.Details.create',[
            'plan' => $plan
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DetailPlanRequest $request,Plan $plan)
    {
        if (!$plan) {
            return redirect()->back();
        }
        $plan->details()->create($request->all());
        return redirect()->route('details.plans.index',$plan->url);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Plan $plan,DetailPlan $detail)
    {
        return view('Admin.Pages.Plans.Details.show',[
            'plan' => $plan,
            'detail' => $detail,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan,DetailPlan $detail)
    {
        if (!$detail) {
            return redirect()->back();
        }
        return view('Admin.Pages.Plans.Details.edit',[
            'plan' => $plan,
            'detail' => $detail
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DetailPlanRequest $request,Plan $plan, DetailPlan $detail)
    {
        if (!$detail) {
            return redirect()->back();
        }
        $detail->update($request->all());
        return redirect()->route('details.plans.show',[$plan->url,$detail->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Plan $plan,DetailPlan $detail)
    {
        if (!$detail) {
            return redirect()->back();
        }
        $detail->delete();
        return redirect()->route('details.plans.index',$plan->url)->with('message', 'Detalhe deletado com sucesso!');
    }
}

<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index(Plan $plans)
    {
        return view('Site.Pages.Home.index',[
            'plans' => $plans->with('details')->orderBy('price','ASC')->get()
        ]);
    }

    public function plan(Plan $plan)
    {
        if(!$plan){
            return redirect()->back();
        }
        session()->put('plan',$plan);
        return redirect()->route('register');
    }
}

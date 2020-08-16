<?php

namespace App\Http\Controllers\Admin;

use App\Models\Table;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TableController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Table $tables)
    {
        return view('Admin.Pages.Tables.index',[
            'tables' => $tables->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Tables.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Table $table)
    {
        $table->create($request->all());
        return redirect()->route('tables.index')->with('message','Mesa Cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Table $table)
    {
        return view('Admin.Pages.Tables.show',[
            'table' => $table
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Table $table)
    {
        if (!$table) {
            return redirect()->back()->with('error',"Mesa não encontrada!");
        }
        return view('Admin.Pages.Tables.edit',[
            'table' => $table
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Table $table)
    {
        if (!$table) {
            return redirect()->back()->with('error',"Mesa não encontrada!");
        }
        $table->update($request->all());
        return redirect()->route('tables.index')->with('message',"Mesa atualizada com sucesso!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Table $table)
    {
        if (!$table) {
            return redirect()->back()->with('error',"Mesa não encontrada!");
        }
        $table->delete();
        return redirect()->route('tables.index')->with('message',"Mesa removida com sucesso!");
    }

    public function search(Table $table, Request $request)
    {
        return view('Admin.Pages.Tables.index', [
            'tables' => $table->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
}

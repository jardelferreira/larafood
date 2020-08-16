<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()       
    {
        $this->middleware(['can:categories']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Category $categories)
    {
        return view('Admin.Pages.Categories.index',[
            'categories' => $categories->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request, Category $category)
    {
        $category->create($request->all());
        return redirect()->route('categories.index')->with('message','Categoria Cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view('Admin.Pages.Categories.show',[
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        if (!$category) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        return view('Admin.Pages.Categories.edit',[
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        if (!$category) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        $category->update($request->all());
        return redirect()->route('categories.index')->with('message',"Categoria atualizada com sucesso!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        if (!$category) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        $category->delete();
        return redirect()->route('categories.index')->with('message',"Categoria removida com sucesso!");
    }

    public function search(Category $category, Request $request)
    {
        return view('Admin.Pages.Categories.index', [
            'categories' => $category->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
}

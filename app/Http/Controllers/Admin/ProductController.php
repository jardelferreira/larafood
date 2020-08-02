<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Product $products)
    {
        return view('Admin.Pages.Products.index',[
            'products' => $products->paginate(2)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.Pages.Products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request, Product $product)
    {
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        if ($request->hasFile('image') && $request->image->isValid()) {
          $data['image'] = $request->image->store("public/tenants/{$tenant->uuid}/products");
        }
        $product->create($data);
        return redirect()->route('products.index')->with('message','Categoria Cadastrada com sucesso!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('Admin.Pages.Products.show',[
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        return view('Admin.Pages.Products.edit',[
            'product' => $product
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        $tenant = auth()->user()->tenant;
        $data = $request->all();
        if ($request->hasFile('image') && $request->image->isValid()) {
            if (Storage::exists($product->image)) {
                Storage::delete($product->image);
            }
          $data['image'] = $request->image->store("public/tenants/{$tenant->uuid}/products");
        }
        $product->update($data);
        return redirect()->route('products.index')->with('message',"Categoria atualizada com sucesso!");

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error',"Categoria não encontrada!");
        }
        if (Storage::exists($product->image)) {
            Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('products.index')->with('message',"Categoria removida com sucesso!");
    }

    public function search(Product $product, Request $request)
    {
        return view('Admin.Pages.Products.index', [
            'products' => $product->search($request->filter),
            'filters' => $request->except('_token')
        ]);
    }
}

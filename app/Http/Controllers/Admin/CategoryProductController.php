<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Category;

class CategoryProductController extends Controller
{
    public function __construct()       
    {
        $this->middleware(['can:categories','can:products']);
    }
    public function categories(Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error','Não foi possível encontrar o produto');
        }
        return view('Admin.Pages.Products.Categories.index',[
            'categories' => $product->categories()->paginate(),
            'product' => $product
        ]);
    }

    public function attachCategoriesProduct(Request $request, Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        if (!$request->categories || count($request->categories) < 1) {
            return redirect()->back()->with('info','Selecione uma permissão!');
        }
        $product->categories()->attach($request->categories);
        return redirect()->route('products.categories',$product->id);
    }

    public function detachCategoriesProduct(Product $product,Category $category)
    {
        if (!$product || !$category) {
            return redirect()->back()->with('error','Perfil inexistente!');
        }
        $product->categories()->detach($category);

        return redirect()->route('product.categories',$product->id);
    }
    
    public function categoriesProductCreate(Product $product)
    {
        if (!$product) {
            return redirect()->back()->with('error','Produto não encontrado!');
        }
        return view('Admin.Pages.Products.Categories.create',[
            'product' => $product,
            'categories' => $product->categoriesAvailable()
        ]);
    }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\ProductResource;
use App\Services\ProductServices;
use Illuminate\Http\Request;

class ProductApiController extends Controller
{
    protected $productServices;
    public function __construct(ProductServices $productServices)
    {
        $this->productServices = $productServices;
    }

    public function products(TenantFormRequest $request)
    {
       // dd(is_array($request->get('categories')));
        $products = $this->productServices->getProductsByTenantUuid($request->token_company, $request->get('categories',[]));
        

        if (!$products) {
            return response()->json(['message' => 'Não foi possível localizar os produtos para esta empresa'],404);
        }
        return ProductResource::collection($products);
    }

    public function product(TenantFormRequest $request, string $flag)
    {
        $product = $this->productServices->getProduct($flag);
        if(!$product){
            return response()->json(['message' => 'Não foi possível localizar o produto'],404);
        }
        return ProductResource::collection($product);
    }
}

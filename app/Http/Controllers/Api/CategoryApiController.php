<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryServices;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    protected $categoryServices;
    public function __construct(CategoryServices $categoryServices)
    {
        $this->categoryServices = $categoryServices;
    }

    public function categoriesByTenant(TenantFormRequest $request)
    {
         
        $categories = $this->categoryServices->getCategoriesByUuid($request->token_company);
        return CategoryResource::collection($categories);
    }
}

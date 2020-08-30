<?php
namespace App\Repositories;

use App\Repositories\Contracts\ProductRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ProductRepository implements ProductRepositoryInterface
{
    protected $table;

    public function __construct()
    {
        $this->table = 'products';
    }

    public function getProductsByTenantUuid(string $uuid)
    {
        return  DB::table($this->table)->join('tenants','tenants.id','=','products.tenant_id')
        ->where('tenants.uuid',$uuid)
        ->select('products.*')
        ->get();
    }
    public function getProductsByTenantId(int $idTenant, array $categories)
    {
        return DB::table($this->table)
            ->join('category_product','category_product.product_id','=','products.id') 
            ->join('categories','categories.id','=','category_product.category_id')       
            ->where('products.tenant_id',$idTenant)
            ->where('categories.tenant_id',$idTenant)
            ->where(function($query) use ($categories){
                if ($categories != []) {
                    $query->whereIn('categories.url',$categories);
                }
            })
            ->get();
    }
    public function getProduct(string $flag)
    {
        return DB::table($this->table)->where('flag',$flag)->first();
    }
}
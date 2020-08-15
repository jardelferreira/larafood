<?php

namespace App\Models;

use App\Tenant\Traits\TenantTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Request;

class Product extends Model
{
    use TenantTrait;
    
    protected $fillable = [
        'title',
        'flag',
        'price',
        'description',
        'image'
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function search($filter = null)
    {
        return  $this
        ->latest()
        ->where('flag', 'LIKE', "%$filter%")
        ->orWhere('title',$filter)
        ->paginate(2);
    }

    public function categoriesAvailable($filter = null)
    {
        return Category::whereNotIn('categories.id', function($query){
            $query->select('category_product.category_id');
            $query->from('category_product');
            $query->whereRaw("category_product.product_id={$this->id}");
        })
        ->where(function($queryFilter) use ($filter){
            if($filter)
            $queryFilter->where('categories.name',"lIKE","%{$filter}%");
        })
            ->paginate();
    }
}

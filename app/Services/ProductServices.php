<?php
namespace App\Services;

use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class ProductServices
{
    protected $productRepository,$tenantRepository;

    public function __construct(ProductRepositoryInterface $productRepository, TenantRepositoryInterface $tenantRepository)
    {
        $this->productRepository = $productRepository;
        $this->tenantRepository = $tenantRepository;
    }

    public function getProductsByTenantUuid(string $uuid, array $categories)
    {
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
       return  $this->productRepository->getProductsByTenantId($tenant->id, $categories);
    }

    public function getProduct(string $identify)
    {
        return $this->productRepository->getProduct($identify);
    }
}
<?php
namespace App\Services;

use App\Repositories\Contracts\CategoryRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class CategoryServices
{
    protected $tenantRepository, $categoryRepository;
    public function __construct(
        TenantRepositoryInterface $tenantRepository,
        CategoryRepositoryInterface $categoryRepository)
    {
        $this->tenantRepository = $tenantRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesByUuid(string $uuid)
    {
        
        //$tenant = $this->tenantRepository->getTenantByUuid($uuid);
        return $this->categoryRepository->getCategoriesByTenantUuid($uuid);
    }
}
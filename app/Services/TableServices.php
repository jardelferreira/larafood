<?php
namespace App\Services;

use App\Repositories\Contracts\TableRepositoryInterface;

class TableServices
{
    protected $tableRepository;

    public function __construct(TableRepositoryInterface $tableRepository)
    {
        $this->tableRepository = $tableRepository;
    }

    public function getTablesByTenantUuid(string $uuid)
    {
        return $this->tableRepository->getTablesByTenantUuid($uuid);
    
    }
    public function getTableByUuid(string $uuid)
    {
        return $this->tableRepository->getTableByUuid($uuid);
    }
}
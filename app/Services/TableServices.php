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
    public function getTableByIdentify(string $identify)
    {
        return $this->tableRepository->getTableByIdentify($identify);
    }
}
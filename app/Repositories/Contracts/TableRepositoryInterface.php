<?php
namespace App\Repositories\Contracts;

interface TableRepositoryInterface
{
    public function getTablesByTenantUuid(string $tenant_id);
    public function getTableByUuid(string $identify);
} 
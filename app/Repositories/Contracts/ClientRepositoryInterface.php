<?php
namespace App\Repositories\Contracts;

use App\Models\Client;

interface ClientRepositoryInterface
{
    public function registerClient(array $client);
    public function getClient(string $identify);
}
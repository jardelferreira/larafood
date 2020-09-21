<?php
namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientServices
{
    protected $clientRepository;
    public function __construct(ClientRepositoryInterface $clientRepository)
    {
        $this->clientRepository = $clientRepository;
    }

    public function registerClient(array $client)
    {
        return $this->clientRepository->registerClient($client);
    }

    public function getClient(string $identify)
    {
        # code...
    }
}
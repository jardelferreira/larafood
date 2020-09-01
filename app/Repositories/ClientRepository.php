<?php
namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;

class ClientRepository implements ClientRepositoryInterface
{
    protected $table, $client;

    public function __construct(Client $client)
    {
     $this->client = $client;   
    }
    public function registerClient(array $client)
    {
        $client['password'] = bcrypt($client['password']);
        return $this->client->create($client);
    }
    public function getClient(int $clientId)
    {
        # code...
    }
}
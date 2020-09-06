<?php
namespace App\Repositories;

use App\Models\Client;
use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Facades\DB;

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
    public function getClient(string $identify)
    {
        return DB::table('clients')->where('uuid',$identify)->first();
    }
}
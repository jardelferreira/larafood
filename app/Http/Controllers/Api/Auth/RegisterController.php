<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ClientRequest;
use App\Http\Resources\ClientResource;
use App\Services\ClientServices;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $clientService;

    public function __construct(ClientServices $clientService)
    {
        $this->clientService = $clientService;
    }

    public function register(ClientRequest $request)
    {
        $client = $this->clientService->registerClient($request->all());
        return new ClientResource($client);
    }

    public function getClient(int $clientId)
    {
        return $this->getClient($clientId);
    }
}
 
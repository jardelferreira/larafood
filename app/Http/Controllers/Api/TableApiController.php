<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TenantFormRequest;
use App\Http\Resources\TableResource;
use App\Models\Table;
use App\Services\TableServices;
use Illuminate\Http\Request;

class TableApiController extends Controller
{
   protected $tableServices;

   public function __construct(TableServices $tableServices)
   {
       $this->tableServices = $tableServices;
   }

   public function tables(TenantFormRequest $request)
   {
    $tables = $this->tableServices->getTablesByTenantUuid($request->token_company);
    if (!$tables) {
        return response()->json(['message' => 'Não foi possível localizar mesas para esta empresa'],404);
    }
    return TableResource::collection($tables);
   }
   public function table(string $identify)
   {
    $table = $this->tableServices->getTableByIdentify($identify);
    if (!$table) {
        return response()->json(['message' => 'Não foi possível localizar mesa'],404);
    }
    return TableResource::collection($table);
   }

}

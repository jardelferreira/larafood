<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\OrderRequest;
use App\Http\Requests\TenantRequest;
use App\Http\Resources\OrderResource;
use App\Models\Order;
use App\Services\OrderServices;
use Illuminate\Http\Request;

class OrderApiController extends Controller
{
   protected $orderService;

    public function __construct(
        OrderServices $orderService
    )
    {
        $this->orderService = $orderService;
    }

    public function store(OrderRequest $request)
    {
        $order = $this->orderService->createOrder($request->all());
        return new OrderResource($order);
    }
    public function order($identify)
    {
        if (!$order = $this->orderService->getOrderByIdentify($identify)) {
            return response()->json(['message' => 'Not found'],404);
        }
        return new OrderResource($order);
    }

    public function myOrders()
    {
        if(!$orders = $this->orderService->getOrdersByClient()){
            return response()->json(['message'=>'Not Found'],404);
        };
        return  OrderResource::collection($orders);

    }
}

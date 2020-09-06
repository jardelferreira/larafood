<?php

namespace App\Repositories;

use App\Models\Order;
use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Support\Facades\DB;

class OrderRepository implements OrderRepositoryInterface
{
    protected $entity;

    public function __construct(
        Order $order
    ) {
        $this->entity = $order;
    }

    public function createOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = "",
        $tableId = "",
        string $comment
    ) {
        $data = [
            'identify' => $identify,
            'total' => $total,
            'status' => $status,
            'tenant_id' => $tenantId,
            'comment' => $comment
        ];
        $clientId ?? $data['client_id'] = $clientId;
        $tableId ?? $data['table_id'] = $tableId;
        return $this->entity->create($data);
    }

    public function getOrderByIdentify(string $identify)
    {
        return $this->entity->where('identify',$identify)->first();
    }
    public function registerProductsOrder(int $orderId,array $products)
    {
        $orderProducts = [];

        foreach ($products as $product) {
            $orderProducts[$product['id']] = [
                'qty' => $product['qty'],
                'price' => $product['price']
            ];
        }
        $this->entity->find($orderId)->products()->attach($orderProducts);
        // foreach ($products as $product) {
        //     array_push($orderProducts,[
        //         'order_id' => $orderId,
        //         'product_id' => $product['id'],
        //         'price' => $product['price'],
        //         'qty' => $product['qty']
        //     ]);
        // }
        // DB::table('order_product')->insert($orderProducts);
    }
}

<?php
namespace App\Repositories\Contracts;

interface OrderRepositoryInterface
{
    public function createOrder(
        string $identify,
        float $total,
        string $status,
        int $tenantId,
        $clientId = "",
        $tableId = "",
        string $comment
    );
    public function getOrderByIdentify(string $identify);
    public function registerProductsOrder(int $orderId,array $products);
    public function getOrdersByClient(int $id);
}
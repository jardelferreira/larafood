<?php
namespace App\Services;

use App\Repositories\Contracts\ClientRepositoryInterface;
use Illuminate\Support\Str;
use App\Repositories\Contracts\OrderRepositoryInterface;
use App\Repositories\Contracts\ProductRepositoryInterface;
use App\Repositories\Contracts\TableRepositoryInterface;
use App\Repositories\Contracts\TenantRepositoryInterface;

class OrderServices
{
    protected $orderRepository,$tenantRepository, $tableRepository,$clientRepository,$productRepository;

    public function __construct(
        OrderRepositoryInterface $orderRepository,
        TenantRepositoryInterface $tenantRepository,
        TableRepositoryInterface $tableRepository,
        ClientRepositoryInterface $clientRepository,
        ProductRepositoryInterface $productRepository
    )
    {
        $this->orderRepository = $orderRepository;
        $this->tenantRepository = $tenantRepository;
        $this->tableRepository = $tableRepository;
        $this->clientRepository = $clientRepository;
        $this->productRepository = $productRepository;
    }

    public function createOrder(array $order)
    {
        $products = $this->getProductsByOrder($order['products']);
        $identify = $this->getIdentify();
        $total = $this->getTotal($products);
        $status = 'open';
        $tenantId = $this->getTenantId($order['token_company']);
        $clientId = $this->getClientId();
        $tableId = $this->getTableId($order['table'] ?? "");
        $comment = isset($order['comment']) ? $order['comment'] : "";
        $order = $this->orderRepository->createOrder(
            $identify,$total,$status,$tenantId,$clientId,$tableId,$comment
        );
        $this->orderRepository->registerProductsOrder($order->id,$products);
        return $order;
    }

    private function getIdentify($length = 10){
        $newIdentify = Str::random($length);
        if($this->orderRepository->getOrderByIdentify($newIdentify)){
            $this->getIdentify($length+1);
        }
        return $newIdentify;
    }

    private function getTotal(array $products):float
    {   
        $total =0;
        foreach ($products as $product) {
            $total += ($product['qty'] * $product['price']);
        }
        return (float) $total;
    }

    private function getTenantId(string $uuid){
        $tenant = $this->tenantRepository->getTenantByUuid($uuid);
        //dd($tenant->id);
        return $tenant->id;
    }

    private function getTableId(string $uuid = '' ){
        if ($uuid) {
            $table = $this->tableRepository->getTableByUuid($uuid);
           return  $table->id;
        }
        return '';
    }

    private function getClientId(){
        return auth()->check() ? auth()->user()->id : "";
    }

    private function getProductsByOrder(array $productsOrder){
        $products = [];

        foreach ($productsOrder as $productOrder) {
            $product = $this->productRepository->getProduct($productOrder['identify']);

            array_push($products,[
                'id' => $product->id,
                'identify' => $product->uuid,
                'qty' => $productOrder['qty'],
                'price' => $product->price
            ]);
        }
       return $products;
    }
}
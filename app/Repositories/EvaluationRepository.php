<?php
namespace App\Repositories;

use App\Models\Evaluation;
use App\Repositories\Contracts\EvaluationRepositoryInterface;

class EvaluationRepository implements EvaluationRepositoryInterface
{
    protected $entity;

    public function __construct(Evaluation $evaluation)
    {
        $this->entity = $evaluation;
    }

    public function newEvaluationOrder(int $order, int $client,array $data)
    {
        $data['client_id'] = $client;
        $data['order_id'] = $order;

        return $this->entity->create($data);
    }

    public function getEvaluationByOrder(int $order)
    {
        return $this->entity->where('order_id',$order)->get();
    }

    public function getEvaluationByClient(int $client)
    {
        return $this->entity->where('client_id',$client)->get();
    }

    public function getEvaluationById(int $id)
    {
        return $this->entity->find($id);

    }

    public function getEvaluationByClientIdOrder(int $client,int $order)
    {
        return $this->entity
            ->where('client_id',$client)
            ->where('order_id',$order)->first();

    }

}
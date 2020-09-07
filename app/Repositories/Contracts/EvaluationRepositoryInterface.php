<?php
namespace App\Repositories\Contracts;

interface EvaluationRepositoryInterface
{
    public function newEvaluationOrder(int $order,int $client, array $data);
    public function getEvaluationByOrder(int $order);
    public function getEvaluationByClient(int $client);
    public function getEvaluationById(int $id);
    public function getEvaluationByClientIdOrder(int $client,int $order);
}
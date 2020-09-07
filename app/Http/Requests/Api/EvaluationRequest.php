<?php

namespace App\Http\Requests;

use App\Repositories\Contracts\OrderRepositoryInterface;
use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    protected $orderRepository;

    public function __construct(OrderRepositoryInterface $orderRepository)
    {
        $this->orderRepository = $orderRepository;
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $order = $this->orderRepository->getOrderByIdentify($this->identify);
        $client = auth()->user();
        
        if(!$client || !$order){
            return false;
        }
        
        return $client->id == $order->client_id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'stars' => 'required|max:5|min:1|integer',
            'comment' => 'nullable|min:3|max:1000'
        ];
    }
}

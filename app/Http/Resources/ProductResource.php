<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
      //dd();
        return [
          'nome' => $this->title,
          'identify' => $this->uuid,
          'descricao' => $this->description,
          'preco' => $this->price,
          'urlImage' => url("storage/{$this->image}")  
        ];
    }
}

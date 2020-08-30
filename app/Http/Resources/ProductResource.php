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
        return [
          'nome' => $this->title,
          'url' => $this->flag,
          'descricao' => $this->description,
          'preco' => $this->price,
          'urlImage' => url("storage/{$this->image}")  
        ];
    }
}

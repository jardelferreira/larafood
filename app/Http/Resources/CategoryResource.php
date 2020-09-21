<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array(
            'nome' => $this->name,
            'descricao' => $this->description,
            'identify' => $this->uuid,
            'criado-em' => Carbon::parse($this->created_at)->format('d/m/Y'),
        );
    }
}
 
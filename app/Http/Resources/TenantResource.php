<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TenantResource extends JsonResource
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
            'nome' => $this->name,
            'email' => $this->email,
            'cnpj' => $this->cnpj,
            'image' => $this->logo ? url("storage/{$this->logo}"): null,
            'criado-em' => Carbon::parse($this->created_at)->format('d/m/Y'),
            'uuid' => $this->uuid
        ];
    }
}
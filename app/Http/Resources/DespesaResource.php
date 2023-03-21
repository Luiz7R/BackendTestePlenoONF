<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DespesaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'descricao' => $this->descricao,
            'id_usuario' => $this->id_usuario,
            'data_despesa' => $this->data_despesa,
            'valor' => $this->valor,
        ];
    }
}

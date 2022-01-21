<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClienteResource extends JsonResource
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
            'id'=>$this->id,
            'nombre' => $this->nombre,
            'apaterno' => $this->apaterno,
            'amaterno' => $this->amaterno,
            'email' => $this->email,
            'celular' => $this->celular,
        ];
    }
}

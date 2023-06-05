<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class HeroResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'alias' => $this->alias,
            'power' => $this->power,
            'url'   => $this->url,
            'created_at' =>$this->created_at->format('d-m-Y:i:s'),
            'updated_at' =>$this->updated_at->format('d-m-Y:i:s')
        ];
    }
}

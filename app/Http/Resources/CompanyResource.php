<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CompanyResource extends JsonResource
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
            'uuid' => $this->uuid,
            'name'  => $this->name,
            'hero' => new HeroResource($this->hero),
            'email' => $this->email,
            'url'   => $this->url,
            'image' =>$this->image,
            'created_at' =>$this->created_at->format('d-m-Y:i:s'),
            'updated_at' =>$this->updated_at->format('d-m-Y:i:s')
        ];
    }
}

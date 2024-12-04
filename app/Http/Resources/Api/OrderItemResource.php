<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'id' => $this->id,
            'name' => $this->product?->name,
            'images' => $this->product?->images,
            'price' => $this->price . __(" Ryal Saudi"),
            'quantity' => $this->quantity,
        ];
    }
}

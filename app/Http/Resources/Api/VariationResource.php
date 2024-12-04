<?php

namespace App\Http\Resources\Api;

use App\Models\Scopes\SortingScope;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VariationResource extends JsonResource
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
            'size' => $this->size,
            'weight' => $this->weight,
            'price' => $this->price,
            'discount_price' => $this->discount_price,
            'discount_from' => $this->discount_from,
            'discount_to' => $this->discount_to,
            'stock' => $this->stock,
            'status' => $this->stock == 0 ? 'Out Stock' : 'In Stock'
        ];
    }
}

<?php

namespace App\Http\Resources\Api;

use App\Enums\OrderStatus;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'status' => __($this->status),
            'status_id' => match (OrderStatus::fromString($this->status)->value) {
                5 => 1,
                7, 8 => 3,
                default => 2,
            },
            'total_price' => $this->total_price,
            'payment_method' => $this->paying_off == 2 ? __('Prepaid Cards') : __('Cash on delivery'),
            'created_at' => $this->created_at->format('d M Y'),
            'address' => $this->address->city->name . ',' . $this->address->district . ',' . $this->address->street_name . ',' . $this->address->building_number,
            'products' => OrderItemResource::collection($this->orderItems)
        ];
    }
}

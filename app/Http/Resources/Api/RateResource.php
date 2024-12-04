<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RateResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id"=> $this->id,
            "customer_name" => $this->customer->name,
            "customer_image" => $this->customer->full_image_path,
            "rate"=> $this->rate,
            "comment" => $this->comment,
            "status" => $this->status,
            // "truncatedText" => "",
            // 'created_at' => $this->created_at->diffForHumans()
        ];
    }
}

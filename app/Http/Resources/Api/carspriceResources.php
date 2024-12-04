<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class carspriceResources extends JsonResource
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
            'type' => $this->type,
            'price' => $this->price,

            'car' => [
                'id' => $this->cars->id,
                'name' => $this->cars->name,
                'price' => $this->cars->price,
                'image' => $this->cars->full_image_path,
                'passenger_count' => $this->cars->passengers_counts,
                'bags_count' => $this->cars->bags_counts,
                'category' => [
                    'id' => $this->cars->category->id,
                    'name' => $this->cars->category->name,
                ]
            ]
        ];
        
        }
}

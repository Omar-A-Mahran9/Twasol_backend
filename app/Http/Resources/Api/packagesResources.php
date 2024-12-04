<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class packagesResources extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>packagesResources
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'price' => $this->price,
            'cities' => $this->cities ? $this->cities->map(function ($city) {
                return [
                    'id' => $city->id,
                    'name' => $city->name,  // Example field, adjust based on your City model
                ];
            }) : [],  // Return an empty array if no cities are associated
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

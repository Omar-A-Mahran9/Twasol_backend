<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PartenersResource extends JsonResource
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
                'name_ar' => $this->name_ar,
                'name_en' => $this->name_en,
                'image' => $this->full_image_path, // Assuming the image is stored in Laravel's storage
            ];    }
}

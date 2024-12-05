<?php

namespace App\Http\Resources\Api;

use App\Models\blogs;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
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
            'image' => $this->full_image_path,
            'name' => $this->name,
            'created' => \Carbon\Carbon::parse($this->created_at)->format('d/m/Y'), // Formats as 31/12/2024        
      
                ];
    }
}

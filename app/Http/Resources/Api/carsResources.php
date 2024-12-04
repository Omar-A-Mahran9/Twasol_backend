<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class carsResources extends JsonResource
{

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

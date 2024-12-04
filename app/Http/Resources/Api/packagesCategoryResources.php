<?php

namespace App\Http\Resources\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class packagesCategoryResources extends JsonResource
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
            'name' => $this->name,
            'packagesubCategories' => $this->packagesubCategories->map(function ($category) {
                return [
                    'id' => $category->id,
                    'name' => $category->name,  // Adjust based on your PackageSubCategory model
                    // Add more fields as needed
                ];
            }),

        ];
        
        }
}

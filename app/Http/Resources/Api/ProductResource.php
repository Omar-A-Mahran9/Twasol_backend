<?php

namespace App\Http\Resources\Api;

use App\Models\Scopes\SortingScope;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $fastShipping = $this->productCities->map(function ($productCity) {
            return $productCity->fastShipping ? $productCity->fastShipping->cities : null;
        })->filter()->unique();
        $min          = $this->specifications()->orderBy('size', 'asc')->first();
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $min->price ?? $this->price,
            'caliber' => $this->caliber,
            'weight' => $min->weight ?? $this->weight,
            'size' => $min->size ?? $this->size,
            'discount_price' => $min->discount_price ?? null,
            'discount_from' => $min->discount_from ?? null,
            'discount_to' => $min->discount_to ?? null,
            'video_link' => $this->video_link,
            'maintenance_and_care' => $this->maintenance_and_care,
            'packaging' => $this->packaging,
            'sustainable_assets' => $this->sustainable_assets,
            'main_stone' => $this->main_stone,
            'guarantee' => $this->guarantee,
            'color' => $this->color,
            'vendor_id' => $this->vendor ? $this->vendor->id : null,
            'vendor_name' => $this->vendor ? $this->vendor->brand : null,
            'meta_tag_key_words' => $this->meta_tag_key_words,
            'meta_tag_key_description' => $this->meta_tag_key_description,
            'fast_shipping_cities' => CityResource::collection(resource: $fastShipping),
            'images' => $this->images,
            'category' => implode(" , ", $this->categories()->withoutGlobalScope(SortingScope::class)->select('name_ar', 'name_en')->get()->pluck('name')->toArray()),
            'subcategory' => new SubcategoryResource($this->subcategoriesNew()->first()),
            'rate' => $this->rate,
            'tax' => (setting('tax') / 100),
            'variations' => VariationResource::collection($this->specifications)
        ];
    }
}

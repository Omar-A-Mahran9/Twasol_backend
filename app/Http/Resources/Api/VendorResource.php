<?php

namespace App\Http\Resources\Api;

use App\Models\Product;
use App\Models\Rate;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VendorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $product = request()->route('product');
        if (!$product) {
            $highestRate = Rate::max('rate');

            $lowestRate = Rate::min('rate');
        }
        $bestSellerProducts = $this->products()->with('specifications', 'categories', 'subcategories', 'images', 'vendor.cities')->withCount('orderItems')->orderByDesc('order_items_count')->take(3)->get();

        return [
            'id' => $this->id,
            'name' => $this->brand??$this->name,
            'description' => $this->description,
            'logo' => $this->logo_path,
            'cover' => $this->cover_path,
            'products_count' => $this->loadCount('products')->products_count,
            'commercial_register_number' => $this->commercial_register_number,
            'bestSellerProducts' => ProductResource::collection($bestSellerProducts),
            'rate' => $product ? $product->rate : round(($highestRate + $lowestRate) / 2, 1),
            'created_at' => $this->created_at->format('d M Y'),
        ];
    }
}

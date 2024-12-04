<?php

namespace App\Rules;

use App\Http\Resources\Api\ProductResource;
use App\Models\Product;
use App\Models\Vendor;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateFastShippings implements ValidationRule
{
    
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $unavailableProductsForFastShipping = collect();

        if(request()->fast_shipping)
        {
            foreach(request()->products as $item)
            {
                $product = Product::whereHas('vendor', function($query){
                    $query->whereHas('cities', function($q){
                        $q->where('city_id', request()->city)->where('fast_shipping', FALSE);
                    });
                })->find($item['id']);

                $unavailableProductsForFastShipping->add($product);
            }
        }
        $fail(json_encode($unavailableProductsForFastShipping));
    }
}

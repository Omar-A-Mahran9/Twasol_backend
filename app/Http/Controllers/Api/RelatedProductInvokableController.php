<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\ProductSpecification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;

class RelatedProductInvokableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request, Product $product)
    {
        if (setting('vendors'))
        {
            $query               = Product::query();
            $vendorsIDs          = collect(setting('vendors'))->pluck('id')->toArray();
            $filterByPrice       = collect(setting('filters'))->contains('price');
            $filterByCategory    = collect(setting('filters'))->contains('category');
            $filterBySubcategory = collect(setting('filters'))->contains('subcategory');
            $productMin          = $product->specifications()->orderBy('size', 'asc')->first();

            $query->when($filterByCategory, function ($query) use ($product) {
                $productCategories = $product->categories()->pluck('category_id')->toArray();
                return $query->where('id', '!=', $product->id)->whereHas('categories', function ($query) use ($productCategories) {
                    $query->whereIn('category_id', $productCategories);
                });
            });

            $query->when($filterBySubcategory, function ($query) use ($product) {
                $productCategories = $product->subcategories()->pluck('category_id')->toArray();
                return $query->where('id', '!=', $product->id)->whereHas('subcategories', function ($query) use ($productCategories) {
                    $query->whereIn('category_id', $productCategories);
                });
            });

            $query->when($filterByPrice, function ($query) use ($product, $productMin) {
                $productPrice = $productMin->price;
                $maxPrice     = ProductSpecification::max('price');
                $minPrice     = ProductSpecification::min('price');
                return $query->where('id', '!=', $product->id)
                    ->whereHas('specifications', function ($q) use ($maxPrice, $minPrice, $productPrice) {
                        $q->where(function ($q) use ($maxPrice, $minPrice, $productPrice) {
                            $q->when($maxPrice == $productPrice, function ($query) use ($minPrice, $productPrice) {
                                return $query->whereBetween('price', [$productPrice - $minPrice, $productPrice]);
                            });
                            $q->when($minPrice == $productPrice, function ($query) use ($maxPrice, $productPrice) {
                                return $query->whereBetween('price', [$productPrice, $maxPrice - $productPrice]);
                            });
                            $q->when($minPrice != $productPrice && $maxPrice != $productPrice, function ($query) use ($minPrice, $maxPrice, $productPrice) {
                                return $query->whereBetween('price', [$productPrice - $minPrice, $maxPrice - $productPrice]);
                            });
                        })->orderByRaw('ABS(price - ?)', [$productPrice]);
                    });
            });

            $products = $query->whereHas('vendor', function ($query) use ($vendorsIDs) {
                return $query->whereIn('id', $vendorsIDs);
            })->take(20)->get();

        } else
        {
            $productCategories    = $product->categories()->pluck('category_id')->toArray();
            $productSubcategories = $product->subcategories()->pluck('category_id')->toArray();
            $products             = Product::where('id', '!=', $product->id)->whereHas('categories', function ($query) use ($productCategories) {
                $query->whereIn('category_id', $productCategories);
            })->whereHas('subcategories', function ($query) use ($productSubcategories) {
                $query->whereIn('category_id', $productSubcategories);
            })->take(20)->get();
        }

        return $this->success('', ProductResource::collection($products));
    }
}

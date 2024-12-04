<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\ProductRateRequest;
use App\Http\Resources\Api\CustomerRateResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\RateResource;
use App\Http\Resources\Api\VendorResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rate;
use App\Models\Tag;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'tag_id' => 'nullable|exists:tags,id',
            'category_id' => 'nullable|exists:categories,id',
            'subcategory_id' => 'nullable|exists:sub_categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'search_value' => 'nullable|min:3',
        ]);

        $tagID = $request->tag_id;

        if ($request->search_value && $request->search_value != '') {
            $language    = $request->header('Content-Language') ?? 'ar';
            $productType = request()->search_value == 'جديد' ? 'New' : (request()->search_value == 'مستعمل' ? 'Used' : request()->search_value);
            $query       = Product::query();

            $query->when($request->category_id, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q) use ($request) {
                    $q->where('category_id', $request->category_id);
                });
            });

            $query->where(function ($q) use ($language, $productType) {
                $q->whereHas('vendor', function ($q) use ($language) {
                    $q->where('brand_name_' . $language, 'LIKE', "%" . request()->search_value . "%");
                    $q->where('name', 'LIKE', "%" . request()->search_value . "%");
                })->orWhereHas('brand', function ($q) use ($language) {
                    $q->where('name_' . $language, 'LIKE', "%" . request()->search_value . "%");
                })->orWhereHas('specifications', function ($q) {
                    $q->orWhere('size', 'LIKE', "%" . request()->search_value . "%")
                        ->orWhere('weight', 'LIKE', "%" . request()->search_value . "%")
                        ->orWhere('price', 'LIKE', "%" . request()->search_value . "%")
                        ->orWhere('discount_price', 'LIKE', "%" . request()->search_value . "%");
                })
                    ->orWhere('name_' . $language, 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('description_' . $language, 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('caliber', 'LIKE', "%" . request()->search_value . "%")
                    // ->orWhere('size', 'LIKE', "%" . request()->search_value . "%")
                    // ->orWhere('weight', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('main_stone', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('color', 'LIKE', "%" . request()->search_value . "%")
                    // ->orWhere('price', 'LIKE', "%" . request()->search_value . "%")
                    // ->orWhere('discount_price', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('type', 'LIKE', "%" . $productType . "%");
            });

            $products = $query->paginate(8);
            return $this->successWithPagination("", ProductResource::collection($products)->response()->getData(true));
        }

        if ($tagID) {
            $query = Product::query();

            $query->when($request->category_id, function ($q) use ($request) {
                return $q->whereHas('categories', function ($q) use ($request) {
                    return $q->where('category_id', $request->category_id);
                });
            });
            $query->when($request->subcategory_id, function ($q) use ($request) {
                return $q->whereHas('subcategoriesNew', function ($q) use ($request) {
                    return $q->where('sub_category_id', $request->subcategory_id);
                });
            });
            $query->when($request->brand_id, function ($q) use ($request) {
                return $q->where('brand_id', $request->brand_id);
            });

            $productsFilteredByTag = $query->whereHas('tags', function ($q) use ($tagID) {
                $q->where('tag_id', $tagID);
            })->with('specifications', 'categories', 'subcategoriesNew', 'vendor.cities')->withCount('orderItems')->orderByDesc('order_items_count')->paginate(8);

            return $this->successWithPagination("", ProductResource::collection($productsFilteredByTag)->response()->getData(true));
        }

        if ($request->category_id) {
            $productsFilteredByCategory = Category::with([
                'products' => function ($query) {
                    return $query->with('specifications', 'categories', 'subcategoriesNew', 'vendor.cities')->withCount('orderItems')->orderByDesc('order_items_count');
                }
            ])->find($request->category_id)->products()->paginate(8);

            return $this->successWithPagination("", ProductResource::collection($productsFilteredByCategory)->response()->getData(true));
        }
    }

    public function show(Product $product)
    {
        return $this->success('', new ProductResource($product));
    }

    public function rate(ProductRateRequest $request, Product $product)
    {
        Rate::create([
            'customer_id' => auth()->user()->id,
            'product_id' => $product->id,
            'comment' => $request->comment,
            'rate' => $request->rate,
        ]);

        $recommendationPercentage = $this->calculateRecommendationPercentage($product);

        return $this->success('', [
            'comments_count' => $product->rates()->count('comment'),
            'is_recommended' => $recommendationPercentage ? TRUE : FALSE,
            'recommendationPercentage' => $recommendationPercentage,
            'customers_rates' => RateResource::collection($product->rates()->orderByDesc("created_at")->get())
        ]);
    }

    public function rates(Product $product)
    {
        $recommendationPercentage = $this->calculateRecommendationPercentage($product);

        return $this->success('', [
            'comments_count' => $product->rates()->count('comment'),
            'is_recommended' => $recommendationPercentage ? TRUE : FALSE,
            'recommendationPercentage' => $recommendationPercentage,
            'customers_rates' => RateResource::collection($product->rates()->orderByDesc("created_at")->get())
        ]);
    }

    public function aboutVendor(Request $request, Product $product)
    {
        return $this->success('', new VendorResource($product->vendor));
    }

    protected function calculateRecommendationPercentage(Product $product)
    {
        $totalRates        = $product->rates->count();
        $totalRatePoints   = $product->rates->sum('rate');
        $maxPossiblePoints = $totalRates * 5; // Assuming a rating scale from 1 to 5

        $averageRatePercentage = $maxPossiblePoints > 0 ? ($totalRatePoints / $maxPossiblePoints) * 100 : 0;

        return $averageRatePercentage >= 80 ? $averageRatePercentage : FALSE;
    }
}

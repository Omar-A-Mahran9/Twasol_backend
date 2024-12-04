<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\ProductResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categoryProducts(Request $request, Category $category)
    {
        $category->loadCount('products');

        $query = $category->products();

        $query->when($request->subcategory_id, function ($query) use ($request) {
            $query->whereHas('subcategoriesNew', function ($q) use ($request) {
                $q->where('sub_category_id', $request->subcategory_id);
            });
        });

        $query->when($request->brand_id, function ($query) use ($request) {
            $query->where('brand_id', $request->brand_id);
        });

        $products = $query->paginate(16);

        return $this->success('', [
            'category_id' => $category->id,
            'category_name' => $category->name,
            'category_image' => $category->full_image_path,
            "products_count" => $category->products_count,
            'products' => ProductResource::collection($products)->response()->getData(true)
        ]);
    }
}

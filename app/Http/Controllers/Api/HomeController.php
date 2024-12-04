<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\AdResource;
use App\Http\Resources\Api\BlogResource;
use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\QuestionResource;
use App\Http\Resources\Api\SliderResource;
use App\Http\Resources\Api\SubcategoryResource;
use App\Http\Resources\Api\TagResource;
use App\Models\Ad;
use App\Models\blogs;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CommonQuestion;
use App\Models\NewsLetter;
use App\Models\Product;
use App\Models\Slider;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getBrands()
    {
        $brands = Brand::get();

        return $this->success('', BrandResource::collection($brands));
    }

    public function getblogs()
    {
        $blogs = blogs::get();

        return $this->success('', BlogResource::collection($blogs));
    }

    public function getblog($id)
    {
        $blog = blogs::find($id);

        $relatedBlogs = blogs::where('id', '!=', $id)
        ->inRandomOrder()
        ->take(5)
        ->get();

        $blog['relatedBlogs']= $relatedBlogs;
 
        return $this->success('', $blog);
    }

    public function getQuestions()
    {
        $CommonQuestion = CommonQuestion::get();

        return $this->success('', QuestionResource::collection($CommonQuestion));
    }
    
    public function getCategories()
    {
        $categories = Category::whereNull('parent_id')->withCount('products')->with('subcategories')->get();

        return $this->success('', CategoryResource::collection($categories));
    }

    public function getSubcategories(Request $request)
    {
        $request->validate([
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $query = Category::query();

        $query->when($request->category_id, function ($q) use ($request) {
            return $q->where('id', $request->category_id)->with('subcategories');
        });
        $subcategories       = $query->get();
        return $this->success('', SubcategoryResource::collection($subcategories->pluck('subcategories')->flatten()));
    }

    public function getProducts(Request $request)
    {
        $request->validate([
            'tag_id' => 'required|exists:tags',
        ]);

        $tagID = $request->tag_id;

        $productsFilteredByTag = Tag::with([
            'products' => function ($query) {
                return $query->with('specifications', 'categories', 'subcategoriesNew', 'vendor.cities')->withCount('orderItems')->orderByDesc('order_items_count');
            }
        ])->find($tagID)->products;
        //$products = Product::with('categories')->withCount('orderItems')->limit('4')->get();

        return $this->success('', ProductResource::collection($productsFilteredByTag));
    }

    public function getTags()
    {
        $tags = Tag::get();

        return $this->success('', TagResource::collection($tags));
    }

    public function getProductSections()
    {
        $latestProducts     = Product::with('specifications', 'categories', 'subcategoriesNew', 'images', 'vendor.cities')->latest()->take(10)->get();
        $bestSellerProducts = Product::with('specifications', 'categories', 'subcategoriesNew', 'images', 'vendor.cities')->withCount('orderItems')->orderByDesc('order_items_count')->take(10)->get();
        $discountedProducts = Product::whereHas('specifications', function ($variation) {
            $variation->whereDate('discount_from', '<=', now()->endOfMonth())->whereDate('discount_to', '>=', now()->startOfMonth());
        })->take(10)->get();

        return $this->success('', [
            'latestProducts' => ProductResource::collection($latestProducts),
            'bestSellerProducts' => ProductResource::collection($bestSellerProducts),
            'discountedProducts' => ProductResource::collection($discountedProducts)
        ]);
    }

    public function getAds()
    {
        $ads = Ad::where('status', 'Active')->get();

        return $this->success('', AdResource::collection($ads));
    }

    public function categoriesSearch(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'search_value' => 'required|min:2',
        ]);
        $language                   = $request->header('Content-Language') ?? 'ar';
        $productType                = request()->search_value == 'جديد' ? 'New' : (request()->search_value == 'مستعمل' ? 'Used' : null);
        $productsFilteredByCategory = Category::with([
            'products' => function ($q) use ($language) {
                return $q->where('category_id', request()->category_id);
            }
        ])->find($request->category_id)->products()->where(function ($q) use ($language, $productType) {
            $q->whereHas('vendor', function ($q) use ($language) {
                $q->where('brand_name_' . $language, 'LIKE', "%" . request()->search_value . "%");
                $q->where('name', 'LIKE', "%" . request()->search_value . "%");
            })->orWhereHas('brand', function ($q) use ($language) {
                $q->where('name_' . $language, 'LIKE', "%" . request()->search_value . "%");
            })->orWhereHas('specifications', function ($variation) {
                $variation->orWhere('size', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('weight', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('price', 'LIKE', "%" . request()->search_value . "%")
                    ->orWhere('discount_price', 'LIKE', "%" . request()->search_value . "%");
            })
                ->where('name_' . $language, 'LIKE', "%" . request()->search_value . "%")
                ->orWhere('description_' . $language, 'LIKE', "%" . request()->search_value . "%")
                ->orWhere('caliber', 'LIKE', "%" . request()->search_value . "%")
                // ->orWhere('size', 'LIKE', "%" . request()->search_value . "%")
                // ->orWhere('weight', 'LIKE', "%" . request()->search_value . "%")
                ->orWhere('main_stone', 'LIKE', "%" . request()->search_value . "%")
                ->orWhere('color', 'LIKE', "%" . request()->search_value . "%")
                // ->orWhere('price', 'LIKE', "%" . request()->search_value . "%")
                // ->orWhere('discount_price', 'LIKE', "%" . request()->search_value . "%")
                ->orWhere('type', 'LIKE', "%" . $productType ?? request()->search_value . "%");
        })->get();
        return $this->success('', ProductResource::collection($productsFilteredByCategory));
    }

    public function newsLetter(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:news_letters'],
        ]);

        NewsLetter::create([
            'email' => $request->email
        ]);

        return $this->success(__('Created Successfully'));
    }

    public function getSliders()
    {
        $sliders = Slider::where('status', '1')->get();

        return $this->success('', SliderResource::collection($sliders));
    }
}
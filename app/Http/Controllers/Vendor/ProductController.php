<?php

namespace App\Http\Controllers\Vendor;

use App\Models\Tag;
use App\Models\City;
use App\Models\Brand;
use App\Models\Image;
use App\Models\Vendor;
use App\Models\Product;
use App\Models\Category;
use App\Models\SkinColor;
use App\Models\CityVendor;
use App\Models\DesignType;
use App\Models\SubCategory;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\ValidationException;
use App\Http\Requests\Vendor\StoreProductRequest;
use App\Http\Requests\Vendor\UpdateProductRequest;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $PER_PAGE = 11;
        if ($request->ajax()) {
            $total    = Product::where('vendor_id', auth()->user()->id)->count();
            $products = Product::query();

            $products->with(['brand', 'categories', 'vendor', 'images']);

            $this->filterQuery($products);

            $products = $products->where('vendor_id', auth()->user()->id)->paginate($PER_PAGE);

            return response(['products' => $products, 'total' => $total]);
        } else
            $tags = Tag::get();

        return view('vendor-dashboard.products.index', compact('tags'));
    }

    public function filterQuery($query)
    {
        if (request()->name != null) {
            $query->when(request()->name, fn($query) => $query->where('name_ar', 'like', "%" . request()->name . "%")->orWhere('name_en', 'like', "%" . request()->name . "%"));
        }

        if (request()->advanced_search != "false") {
            if (isset(request()->status)) {
                $query->when(request()->status != 'all', fn($query) => $query->where('status', request()->status));
            }

            if (isset(request()->arrange_by)) {
                $query->when(request()->arrange_by == 'oldest', fn($query) => $query->orderBy('created_at', 'asc'));
                $query->when(request()->arrange_by == 'latest', fn($query) => $query->orderBy('created_at', 'desc'));
            }

            if (isset(request()->tag)) {
                $query->whereHas('tags', function ($q) {
                    return $q->where('tag_id', request()->tag);
                });
            }
        }
    }

    public function create()
    {
        //$this->authorize('create_products');
        $authShipment = auth()->user()->vendorShipment;

        $categories        = Category::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
        $subCategories     = SubCategory::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en', 'size_applicable')->get();
        $brands            = Brand::select('id', 'name_ar', 'name_en')->get();
        $tags              = Tag::select('id', 'name_ar', 'name_en')->get();
        $skinColors        = SkinColor::select('id', 'name_ar', 'name_en')->get();
        $designTypes       = DesignType::get();
        $vendorCities      = CityVendor::with('city', 'vendor')->whereVendorId(auth()->user()->id)->get()->unique(function ($city) {
            return $city['city_id'] . $city['vendor_id'] . $city['vendor_has_fast_shipping'];
        })->values()->all();
        $goldGramsPrices   = setting('gold_grams_prices');
        $silverGramsPrices = setting('silver_grams_prices');

        // Initialize the new structure
        $goldNewStructure   = array("caliber" => array());
        $silverNewStructure = array("caliber" => array());

        // Loop through the original array and transform it
        if ($goldGramsPrices) {
            foreach ($goldGramsPrices as $key => $value) {
                if (strpos($key, 'caliber_') === 0) {
                    // Extract the caliber number
                    $caliberNumber = str_replace('caliber_', '', $key);
                    // Add it to the new structure
                    $goldNewStructure["caliber"][$caliberNumber] = (int) $value;
                }
            }
        }

        if ($silverGramsPrices) {
            // Loop through the original array and transform it
            foreach ($silverGramsPrices as $key => $value) {
                if (strpos($key, 'caliber_') === 0) {
                    // Extract the caliber number
                    $caliberNumber = str_replace('caliber_', '', $key);
                    // Add it to the new structure
                    $silverNewStructure["caliber"][$caliberNumber] = (int) $value;
                }
            }
        }

        $goldGramsPrices   = $goldNewStructure["caliber"];
        $silverGramsPrices = $silverNewStructure["caliber"];
        return view('vendor-dashboard.products.create', compact('categories', 'brands', 'tags', 'skinColors', 'vendorCities', 'designTypes', 'subCategories', 'goldGramsPrices', 'silverGramsPrices'));
    }

    public function store(StoreProductRequest $request, $step = null)
    {
        //$this->authorize('create_products');

        if (!isset($step)) {
            $allData                              = $request->toArray();
            $dataAttachedWithProduct              = $request->toArray();
            $keysToRemove                         = ['variations', 'cities', 'tags', 'images', 'categories', 'subcategories'];
            $dataAttachedWithProduct              = Arr::except($dataAttachedWithProduct, $keysToRemove);
            $dataAttachedWithProduct['vendor_id'] = auth()->user()->id;
            $cities                               = $allData['cities'];
            $tags                                 = $allData['tags'];
            $categories                           = $allData['categories'];
            $specifications                       = $allData['variations'];

            if ($request->subcategories) {
                $subcategories = $allData['subcategories'];
            }

            if (!$request->price_change) {
                $dataAttachedWithProduct['price_change'] = 0;
            }

            $product = Product::create($dataAttachedWithProduct);

            foreach ($specifications as $specification) {
                $product->specifications()->create([
                    'size' => $specification['size'],
                    'weight' => $specification['weight'],
                    'price' => $specification['price'],
                    'stock' => $specification['stock'],
                    'discount_price' => $specification['discount_price'] ?? null,
                    'discount_from' => $specification['discount_from'] ?? null,
                    'discount_to' => $specification['discount_to'] ?? null,
                ]);
            }
            foreach ($cities as $city) {
                $city = json_decode($city);
                $product->cities()->attach(['city_id' => $city->id]);
            }
            $product->tags()->attach($tags);
            $categoriesWithSubcategory = [];
            foreach ($categories as $categoryId) {
                $categoriesWithSubcategory[$categoryId] = ['sub_category_id' => $subcategories[0]];
            }
            $product->categories()->sync($categoriesWithSubcategory);

            Image::handleProductImages($product->id);

            return response(["Product created successfully"]);
        }
    }

    public function edit(Product $product)
    {
        //$this->authorize('update_products');

        $product->load('brand', 'tags', 'categories', 'subcategories', 'categoriesNew');
        $categories    = Category::withTrashed()->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
        $subcategories     = SubCategory::withTrashed()->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->get();
        //$selectedSubcategories = DB::table('category_product')->whereNotNull('subcategory_id')->select('subcategory_id')->get();
        $designTypes = DesignType::get();
        $brands      = Brand::select('id', 'name_ar', 'name_en')->get();
        $tags        = Tag::select('id', 'name_ar', 'name_en')->get();
        // $skinColors = SkinColor::select('id', 'name_ar', 'name_en')->get();
        $vendorCities      = CityVendor::with('city', 'vendor')->whereVendorId(auth()->user()->id)->get()->unique(function ($city) {
            return $city['city_id'] . $city['vendor_id'];
        })->values()->all();
        $goldGramsPrices   = setting('gold_grams_prices');
        $silverGramsPrices = setting('silver_grams_prices');

        // Initialize the new structure
        $goldNewStructure   = array("caliber" => array());
        $silverNewStructure = array("caliber" => array());

        // Loop through the original array and transform it
        if ($goldGramsPrices) {
            foreach ($goldGramsPrices as $key => $value) {
                if (strpos($key, 'caliber_') === 0) {
                    // Extract the caliber number
                    $caliberNumber = str_replace('caliber_', '', $key);
                    // Add it to the new structure
                    $goldNewStructure["caliber"][$caliberNumber] = (int) $value;
                }
            }
        }

        if ($silverGramsPrices) {
            // Loop through the original array and transform it
            foreach ($silverGramsPrices as $key => $value) {
                if (strpos($key, 'caliber_') === 0) {
                    // Extract the caliber number
                    $caliberNumber = str_replace('caliber_', '', $key);
                    // Add it to the new structure
                    $silverNewStructure["caliber"][$caliberNumber] = (int) $value;
                }
            }
        }

        $goldGramsPrices   = $goldNewStructure["caliber"];
        $silverGramsPrices = $silverNewStructure["caliber"];

        return view('vendor-dashboard.products.edit', compact('categories', 'designTypes', 'goldGramsPrices', 'silverGramsPrices', 'subcategories', 'brands', 'tags', 'vendorCities', 'product'));
    }

    public function update(UpdateProductRequest $request, Product $product, $step = null)
    {
        //$this->authorize('update_products');

        if (!isset($step)) {
            $allData                              = $request->toArray();
            $dataAttachedWithProduct              = $request->toArray();
            $keysToRemove                         = ['variations', 'deletedVariations', 'cities', 'tags', 'images', 'categories', 'subcategories', 'deleted_images'];
            $dataAttachedWithProduct              = Arr::except($dataAttachedWithProduct, $keysToRemove);
            $dataAttachedWithProduct['vendor_id'] = auth()->user()->id;
            $cities                               = $allData['cities'];
            $tags                                 = $allData['tags'];
            $categories                           = $allData['categories'];
            $specifications                       = $allData['variations'];
            $deleteVariations                     = explode(',', $request->deletedVariations[0]);
            $deletedIdsArray                      = array_map('intval', $deleteVariations);
            if ($request->subcategories) {
                $subcategories = $allData['subcategories'];
            }
            if (!$request->price_change) {
                $dataAttachedWithProduct['price_change'] = 0;
            }
            $product->update($dataAttachedWithProduct);
            $product->cities()->detach();
            foreach ($cities as $city) {
                $city = json_decode($city);
                $product->cities()->attach(['city_id' => $city->id]);
            }
            foreach ($specifications as $specification) {

                $variation = ProductSpecification::find($specification['id'] ?? null);
                if ($variation) {
                    $variation->update($specification);
                } else {
                    $product->specifications()->create([
                        'size' => $specification['size'],
                        'weight' => $specification['weight'],
                        'price' => $specification['price'],
                        'stock' => $specification['stock'],
                        'discount_price' => $specification['discount_price'] ?? null,
                        'discount_from' => $specification['discount_from'] ?? null,
                        'discount_to' => $specification['discount_to'] ?? null,
                    ]);
                }
            }

            if ($deletedIdsArray && $deletedIdsArray[0]) {
                foreach ($deletedIdsArray as $id) {
                    $variation = ProductSpecification::findOrFail($id);
                    $variation->delete();
                }
            }
            $product->tags()->sync($tags);
            $product->categories()->detach();
            $categoriesWithSubcategory = [];
            foreach ($categories as $categoryId) {
                $categoriesWithSubcategory[$categoryId] = ['sub_category_id' => $subcategories[0]];
            }
            $product->categories()->sync($categoriesWithSubcategory);
            //$this->syncCategoriesWithSubs($categories, $subcategories, $product);
            Image::handleProductImages($product->id);

            return response(["Product update successfully"]);
        }
    }

    public function show(Product $product)
    {
        //$this->authorize('show_products');

        $product->load('brand', 'vendor', 'images', 'categories', 'tags');
        $vendors                     = Vendor::select('id', 'name')->get();
        $categories                  = Category::select('id', 'name_ar', 'name_en')->get();
        $brands                      = Brand::select('id', 'name_ar', 'name_en')->get();
        $tags                        = Tag::select('id', 'name_ar', 'name_en')->get();
        $metaTag                     = explode(',', $product->meta_tag_key_words);
        $product->meta_tag_key_words = $metaTag;
        return view('vendor-dashboard.products.show', compact('vendors', 'categories', 'brands', 'tags', 'product'));
    }

    public function destroy(Product $product)
    {
        //$this->authorize('delete_products');

        $product->delete();

        return response(["Product deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        //$this->authorize('delete_products');

        Product::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected products deleted successfully"]);
    }

    public function images(Product $product)
    {
        $productImages = $product->images->toArray();
        $images        = scandir(public_path('/storage/Images/ProductImages'));

        foreach ($productImages as $imageName) {
            $imageName = $imageName['name'];

            if (in_array($imageName, $images)) {
                $image['name'] = $imageName;
                $filePath      = public_path("/storage/Images/ProductImages/$imageName");
                $image['size'] = filesize($filePath);
                $image['path'] = asset("/storage/Images/ProductImages/$imageName");
                $data[]        = $image;
            }
        }

        return response()->json($data);
    }

    public function getSubcategories(Request $request)
    {
        // Retrieve selected category IDs from the request
        $selectedCategories = $request->input('categories');

        // Use the selected category IDs to fetch corresponding subcategories
        $subcategories = Category::where('id', $selectedCategories[0])->with('subcategories')->orderBy('id', 'ASC')->get()->pluck('subcategories')->flatten();

        // Return subcategories as HTML options
        $options = '';
        $options .= '<option value=""selected disabled>' .  __("Choose the subcategories") . '</option>';
        foreach ($subcategories as $subcategory) {
            $options .= '<option value="' . $subcategory->id . '">' . $subcategory->name . '</option>';
        }

        return response()->json([
            'options' => $options,
            'subcategories' => $subcategories->pluck('id')
        ]);
    }

    private function attachCategoriesWithSubs($categories, $subcategories, $product)
    {
        collect($categories)->map(function ($category) use ($subcategories, $product) {
            $categoryHasSubs = FALSE;
            collect($subcategories)->each(function ($subcategory) use ($category, $product, $categoryHasSubs) {
                $subcategoryInstance = Category::find($subcategory);
                if ($subcategoryInstance->parent_id == $category) {
                    DB::table('category_product')->insert([
                        'subcategory_id' => $subcategoryInstance->id,
                        'category_id' => $subcategoryInstance->parent_id,
                        'product_id' => $product->id,
                    ]);

                    $categoryHasSubs = TRUE;
                }
                if (!$categoryHasSubs) {
                    DB::table('category_product')->insert([
                        'category_id' => $category,
                        'product_id' => $product->id,
                    ]);
                }
            });
        });
    }

    private function syncCategoriesWithSubs($categories, $subcategories, $product)
    {
        DB::table('category_product')->where('product_id', $product->id)->delete();

        if (!DB::table('category_product')->where('product_id', $product->id)->exists()) {
            collect($categories)->map(function ($category) use ($subcategories, $product) {
                $categoryHasSubs = FALSE;
                collect($subcategories)->each(function ($subcategory) use ($category, $product, $categoryHasSubs) {
                    $subcategoryInstance = Category::find($subcategory);
                    if ($subcategoryInstance->parent_id == $category) {
                        DB::table('category_product')->insert([
                            'subcategory_id' => $subcategoryInstance->id,
                            'category_id' => $subcategoryInstance->parent_id,
                            'product_id' => $product->id,
                        ]);
                    }
                });
                $category = Category::find($category);
                if (!$category->parent_id) {
                    DB::table('category_product')->insert([
                        'category_id' => $category,
                        'product_id' => $product->id,
                    ]);
                }
            });
        }
    }
}

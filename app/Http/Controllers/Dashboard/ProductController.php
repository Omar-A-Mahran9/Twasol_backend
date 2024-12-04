<?php

namespace App\Http\Controllers\Dashboard;

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
use App\Models\CityProduct;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Enums\VendorStatusEnum;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;
use App\Http\Requests\Dashboard\StoreProductRequest;
use App\Http\Requests\Dashboard\UpdateProductRequest;
use App\Models\SubCategory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $PER_PAGE = 11;

        if ($request->ajax()) {
            $total    = Product::count();
            $products = Product::query();


            $products->with([
                'brand' => function ($query) {
                    $query->withTrashed();
                },
                'vendor' => function ($query) {
                    $query->withTrashed();
                },
                'categories' => function ($query) {
                    $query->withTrashed();
                },
                'images'
            ]);
            $this->filterQuery($products);

            $products = $products->paginate($PER_PAGE);

            return response(['products' => $products, 'total' => $total]);
        } else
            $tags = Tag::withTrashed()->get();
        return view('dashboard.products.index', compact('tags'));
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
        $this->authorize('create_products');

        $vendors    = Vendor::select('id', 'name')->where('approved', VendorStatusEnum::Approved->value)->get();
        $categories = Category::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
        $brands     = Brand::select('id', 'name_ar', 'name_en')->get();
        $tags       = Tag::select('id', 'name_ar', 'name_en')->get();
        // $skinColors        = SkinColor::select('id', 'name_ar', 'name_en')->get();
        $cities            = City::select('id', 'name_ar', 'name_en')->get();
        $designTypes       = DesignType::get();
        $subCategories     = SubCategory::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->get();
  
        // Initialize the new structure
        $goldNewStructure   = array("caliber" => array());
        $silverNewStructure = array("caliber" => array());

     

        $goldGramsPrices   = $goldNewStructure["caliber"];
        $silverGramsPrices = $silverNewStructure["caliber"];

        return view('dashboard.products.create', compact('vendors', 'categories', 'brands', 'tags', 'cities', 'vendors', 'designTypes', 'subCategories', 'goldGramsPrices', 'silverGramsPrices'));
    }

    public function store(StoreProductRequest $request, $step = null)
    {
        $this->authorize('create_products');

        if (!isset($step)) {

            $allData                 = $request->toArray();
            $dataAttachedWithProduct = $request->toArray();
            $keysToRemove            = ['variations', 'cities', 'tags', 'images', 'categories', 'subcategories'];

            $dataAttachedWithProduct = Arr::except($dataAttachedWithProduct, $keysToRemove);
            $cities                  = $allData['cities'];
            $tags                    = $allData['tags'];
            $categories              = $allData['categories'];
            $specifications          = $allData['variations'];

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
            // $product->tags()->attach($tags);
            foreach ($cities as $city) {
                // $city = json_decode($city);
                // dd($city);
                $product->cities()->attach(['city_id' => $city]);
            }
            $product->tags()->attach($tags);
            $categoriesWithSubcategory = [];
            foreach ($categories as $categoryId) {
                $categoriesWithSubcategory[$categoryId] = ['sub_category_id' => $subcategories[0]];
            }
            $product->categories()->sync($categoriesWithSubcategory);
            // $product->categoriesNew()->attach($categories, [
            //     'sub_category_id' => $subcategories
            // ]);
            // $product->categories()->attach($categories);
            // if ($request->subcategories) {
            //     $product->subcategories()->attach($subcategories);
            // }
            Image::handleProductImages($product->id);

            return response(["Product created successfully"]);
        }
    }

    public function edit(Product $product)
    {
        $this->authorize('update_products');
        $product->load([
            'brand' => function ($query) {
                $query->withTrashed();
            },
            'designType' => function ($query) {
                $query->withTrashed();
            },
            'vendor' => function ($query) {
                $query->withTrashed();
            },
            'categories' => function ($query) {
                $query->withTrashed();
            },
            'subcategories' => function ($query) {
                $query->withTrashed();
            },
            'tags' => function ($query) {
                $query->withTrashed();
            },
            'specifications',
            'categoriesNew'
        ]);
        $vendors           = Vendor::select('id', 'name')->where('approved', VendorStatusEnum::Approved->value)->withTrashed()->get();
        $categories        = Category::withTrashed()->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
        $subcategories     = SubCategory::withTrashed()->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->get();
        $brands            = Brand::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        $designTypes       = DesignType::withTrashed()->get();
        $tags              = Tag::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        $cities            = City::select('id', 'name_ar', 'name_en')->withTrashed()->get();
       
        // Initialize the new structure
        $goldNewStructure   = array("caliber" => array());
        $silverNewStructure = array("caliber" => array());
 
        $goldGramsPrices   = $goldNewStructure["caliber"];
        $silverGramsPrices = $silverNewStructure["caliber"];

        return view('dashboard.products.edit', compact('vendors', 'categories', 'subcategories', 'goldGramsPrices', 'silverGramsPrices', 'brands', 'tags', 'product', 'cities', 'designTypes'));
    }

    public function update(UpdateProductRequest $request, Product $product, $step = null)
    {
        $this->authorize('update_products');

        if (!isset($step)) {
            $allData                 = $request->toArray();
            $dataAttachedWithProduct = $request->toArray();
            $keysToRemove            = ['variations', 'deletedVariations', 'tags', 'cities', 'images', 'categories', 'subcategories', 'deleted_images'];
            $dataAttachedWithProduct = Arr::except($dataAttachedWithProduct, $keysToRemove);
            $cities                  = $allData['cities'];
            $tags                    = $allData['tags'];
            $categories              = $allData['categories'];
            $specifications          = $allData['variations'];
            $deleteVariations        = explode(',', $request->deletedVariations[0]);
            $deletedIdsArray         = array_map('intval', $deleteVariations);
            if ($request->subcategories) {
                $subcategories = $allData['subcategories'];
            }
            if (!$request->price_change) {
                $dataAttachedWithProduct['price_change'] = 0;
            }
            $product->update($dataAttachedWithProduct);
            $product->cities()->detach();
            foreach ($cities as $city) {
                $product->cities()->attach(['city_id' => $city]);
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
            // $product->categories()->detach();
            $categoriesWithSubcategory = [];
            foreach ($categories as $categoryId) {
                $categoriesWithSubcategory[$categoryId] = ['sub_category_id' => $subcategories[0]];
            }
            $product->categories()->sync($categoriesWithSubcategory);
            // $product->categories()->attach($categories);

            // if ($request->subcategories) {
            //     $product->subcategories()->detach($subcategories);
            //     $product->subcategories()->attach($subcategories);
            // }
            Image::handleProductImages($product->id);

            return response(["Product update successfully"]);
        }
    }

    public function show(Product $product)
    {
        $this->authorize('show_products');

        $product->load([
            'brand' => function ($query) {
                $query->withTrashed();
            },
            'designType' => function ($query) {
                $query->withTrashed();
            },
            'vendor' => function ($query) {
                $query->withTrashed();
            },
            'categories' => function ($query) {
                $query->withTrashed();
            },
            'images',
            'tags' => function ($query) {
                $query->withTrashed();
            },
            'specifications',
            'subcategoriesNew'
        ]);
        $vendors                     = Vendor::select('id', 'name')->withTrashed()->get();
        $categories                  = Category::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        $brands                      = Brand::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        $tags                        = Tag::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        $metaTag                     = explode(',', $product->meta_tag_key_words);
        $product->meta_tag_key_words = $metaTag;
        return view('dashboard.products.show', compact('vendors', 'categories', 'brands', 'tags', 'product'));
    }

    public function destroy(Product $product)
    {
        $this->authorize('delete_products');

        $product->delete();

        return response(["Product deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_products');

        Product::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected products deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_products');

        Product::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected products restored successfully"]);
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
            'subcategories' => $subcategories->pluck('id'),
        ]);
    }

    public function getCitiesBasedOnVendor(Request $request)
    {
        // Retrieve selected vendor ID from the request
        $selectedVendor = $request->input('vendor');
        $product_id     = $request->input('productId');

        // Use the selected category ID to fetch his cities
        $vendorCities = CityVendor::with('city', 'vendor')->whereVendorId($selectedVendor)->get()->unique(function ($city) {
            return $city['city_id'] . $city['vendor_id'] . $city['vendor_has_fast_shipping'];
        })->values()->all();

        $productCities = CityProduct::with('city', 'product')->whereProductId($product_id)->get()->unique(function ($city) {
            return $city['city_id'] . $city['product_id'] . $city['product_has_fast_shipping'];
        })->values()->all();

        return response()->json([
            'productCities' => $productCities,
            'vendorCities' => $vendorCities
        ]);
    }

    public function relatedProductsFilters()
    {
        $vendorsIDs     = collect(setting('vendors'))->pluck('id')->toArray();
        $vendorsFilters = collect(setting('filters'));
        $vendors        = Vendor::select("id", "name")->get();

        return view('dashboard.settings.products.index', compact('vendors', 'vendorsIDs', 'vendorsFilters'));
    }

    public function storeRelatedProductsFilters(Request $request)
    {
        $vendors = [];
        foreach ($request->vendors as $index => $vendor) {
            $vendors[$index] = ['id' => $vendor];
        }
        setting([
            'vendors' => $vendors,
            'filters' => $request->filters
        ])->save();

        return response(["Filters selected successfully"]);
    }

 
    function newGramPrice($newSettings, $currentSettings)
    {
        $updatedValues = [];
        foreach ($newSettings as $key => $newValue) {
            if (isset($currentSettings[$key]) && $currentSettings[$key] != $newValue) {
                if (preg_match('/(\d+)/', $key, $matches)) {
                    $numericPart = $matches[1];
                }
                $updatedValues[$key] = [
                    'caliber' => $numericPart,
                    'old_value' => $currentSettings[$key],
                    'new_value' => $newValue,
                ];
            }
        }
        return $updatedValues;
    }
    function newPriceForProduct($updatedValues): void
    {
        foreach ($updatedValues as $key => $gramPrice) {
            $productChangePrices = Product::where('caliber', $gramPrice['caliber'])->where('price_change', true)->with('specifications')->get();
            foreach ($productChangePrices as $product) {
                foreach ($product->specifications as $specification) {
                    $calculatedPrice = $specification->weight * $gramPrice['new_value'];
                    $specification->update([
                        'price' => $calculatedPrice
                    ]);
                }
            }
        }
    }
}

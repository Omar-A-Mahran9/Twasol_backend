<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCarRequest;
use App\Http\Requests\Dashboard\UpdateCarRequest;
use App\Models\Brand;
use App\Models\Cars;
use App\Models\Category;
use App\Models\Image;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CarsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this->authorize('view_cars');

        $PER_PAGE = 11;
        $cars = Cars::query();
        $total    = Cars::count();

        if ($request->ajax()){
        $cars = $cars->paginate($PER_PAGE);

        return response(['cars' => $cars, 'total' => $total]); 
        }
         else
        $tags = Tag::withTrashed()->get();
        return view('dashboard.cars.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create_cars');

        $categories = Category::select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
        $brands     = Brand::select('id', 'name_ar', 'name_en')->get();
        $tags       = Tag::select('id', 'name_ar', 'name_en')->get();

        return view('dashboard.cars.create', compact('categories', 'brands', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request, $step = null)
    {
        $this->authorize('create_cars');
        if (!isset($step) ) {

            $allData                 = $request->toArray();
            $dataAttachedWithProduct = $request->toArray();
            $keysToRemove            = ['images'];

            $dataAttachedWithProduct = Arr::except($dataAttachedWithProduct, $keysToRemove);
    

        

            $product = Cars::create($dataAttachedWithProduct);
         
          
            Image::handleProductImages($product->id);

            return response(["Product created successfully"]);
        }
     }

    /**
     * Display the specified resource.
     */
    public function show(Cars $cars)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */

     public function edit(Cars $car)
     {
         $this->authorize('update_cars');

         $categories        = Category::withTrashed()->select('id', 'name_ar', 'name_en', 'description_ar', 'description_en')->orderBy('id', 'ASC')->get();
         $brands            = Brand::select('id', 'name_ar', 'name_en')->withTrashed()->get();
         $tags              = Tag::select('id', 'name_ar', 'name_en')->withTrashed()->get();
        

         return view('dashboard.cars.edit', compact( 'car','categories', 'brands', 'tags'));
     }
 

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Cars $car, $step = null)
    {
        $this->authorize('update_products');

        if (!isset($step)) {
            $allData                 = $request->toArray();
            $dataAttachedWithProduct = $request->toArray();
            $keysToRemove            = ['images', 'deleted_images'];
            $dataAttachedWithProduct = Arr::except($dataAttachedWithProduct, $keysToRemove);  
       
            $car->update($dataAttachedWithProduct);  
            Image::handleProductImages($car->id);

            return response(["Product update successfully"]);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cars $car)
    {
        $this->authorize('delete_cars');

        $car->forceDelete();
         return response(["Car deleted successfully"]);    }


    public function images(Cars $car)
    {
        $productImages = $car->images->toArray();
        $images        = scandir(public_path('/storage/Images/CarImages'));

        foreach ($productImages as $imageName) {
            $imageName = $imageName['name'];

            if (in_array($imageName, $images)) {
                $image['name'] = $imageName;
                $filePath      = public_path("/storage/Images/CarImages/$imageName");
                $image['size'] = filesize($filePath);
                $image['path'] = asset("/storage/Images/CarImages/$imageName");
                $data[]        = $image;
            }
        }

        return response()->json($data);
    }
}

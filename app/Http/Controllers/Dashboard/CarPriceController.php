<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreCarPriceRequest;
use App\Http\Requests\Dashboard\UpdateCarPriceRequest;
use App\Models\CarPrice;
use App\Models\Cars;
use App\Models\City;
use Illuminate\Http\Request;

class CarPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_Category =CarPrice::count(); // Get the count of blogs
         $cities = City::get();
         $cars = Cars::get();

         $visited_site=10000;
         if ($request->ajax())
         return response(getModelData(
            model: new CarPrice(),
            relations: [
                'cars' => ['id', 'name_ar', 'description_ar'],  // Eager load 'cars' with specific columns
                'from' => ['id', 'name_ar', 'name_en'],         // Eager load 'from' city with specific columns
                'to' => ['id', 'name_ar', 'name_en'] ,           // Eager load 'to' city with specific columns
                'city' => ['id', 'name_ar', 'name_en']            // Eager load 'to' city with specific columns
                ]
        ));
         else
            return view('dashboard.carPrice.index',compact('count_Category','visited_site','cities','cars'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarPriceRequest $request)
    {
    
         $this->authorize('create_carPrices');

        $data          = $request->validated();

        if ($data['type'] === 'per_trip') {
            $data['city'] = null;
        } else {
            $data['from'] = null;
            $data['to'] = null;
        }
    

         $brand = CarPrice::create($data);

        return response(["Car price created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(CarPrice $carPrice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(CarPrice $carPrice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarPriceRequest $request, CarPrice $carPrice)
    {
        // Authorize the update action
        $this->authorize('update_carPrices');
    
        // Validate the incoming data
        $data = $request->validated();
    
        // Check the type and modify the data accordingly
        if ($data['type'] == 'per_trip') {
            // If type is per_trip, set city to null
            $data['city'] = null;
        } else {
            // Otherwise, set from and to to null
            $data['from'] = null;
            $data['to'] = null;
        }
    
        // Update the CarPrice instance with validated data
        $carPrice->update($data);
    
        // Return a success response
        return response()->json(["message" => "Car price updated successfully"]);
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CarPrice $carPrice)
    {
         $this->authorize('delete_carPrices');

        $carPrice->delete();
        return response(["Car Price deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
         $this->authorize('delete_carPrices');

         CarPrice::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected Car Price deleted successfully"]);
    }
}

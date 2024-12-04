<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePackageRequest;
use App\Http\Requests\Dashboard\UpdatePackageRequest;
use App\Models\Cars;
use App\Models\City;
use App\Models\PackageCategory;
use App\Models\Packages;
use App\Models\PackagesubCategory;
use Illuminate\Http\Request;

class PackagesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_Category =Packages::count(); // Get the count of blogs
         $cities = City::get();
         $cars = Cars::get();
         $categoriesPackage = PackageCategory::get();
         $subcategoriesPackage = PackagesubCategory::get();

         $visited_site=10000;
         if ($request->ajax())
         return response(getModelData(
            model: new Packages(),
            relations: [
                'cars' => ['id', 'name_ar', 'description_ar'],  // Eager load 'cars' with specific columns
                'from' => ['id', 'name_ar', 'name_en'],         // Eager load 'from' city with specific columns
                'to' => ['id', 'name_ar', 'name_en']            // Eager load 'to' city with specific columns
            ]
        ));
         else
            return view('dashboard.packages.index',compact('count_Category','visited_site','cities','cars','categoriesPackage','subcategoriesPackage'));
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
    public function store(StorePackageRequest $request)
    {

        $this->authorize('create_packages');

        $data          = $request->validated();
        $data = collect($data)->except('cities')->toArray();

        $package = Packages::create($data);
        $package->cities()->sync($request->cities);
         return response(["Package created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Packages $packages)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Packages $packages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageRequest $request, Packages $package)
    {
 
        $this->authorize('update_packages');

         $data = $request->validated();
         $package->update($data);
         $package->cities()->sync($request->cities);


        return response(["Package updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Packages $package)
    {
         $this->authorize('delete_packages');

        $package->delete();
        return response(["package deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
         $this->authorize('delete_packages');

        Packages::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected package deleted successfully"]);
    }
}

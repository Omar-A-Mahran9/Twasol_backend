<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePackageCategoryRequest;
use App\Http\Requests\Dashboard\UpdatePackageCategoryRequest;
use App\Models\PackageCategory;
use Illuminate\Http\Request;

class PackageCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
         $count_Category =PackageCategory::count(); // Get the count of blogs
         $visited_site=10000;
         if ($request->ajax())
            return response(getModelData(model: new PackageCategory()));
        else
            return view('dashboard.packageCategories.index',compact('count_Category','visited_site'));
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
    public function store(StorePackageCategoryRequest $request)
    {
        $this->authorize('create_packageCategories');

        $data          = $request->validated();
        $brand = PackageCategory::create($data);

        return response(["PackageCategory created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackageCategory $packageCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePackageCategoryRequest $request, PackageCategory $packageCategory)
    {
 
        $this->authorize('update_packageCategories');

         $data = $request->validated();
        $packageCategory->update($data);

        return response(["Package Category updated successfully"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackageCategory $packageCategory)
    {
        $this->authorize('delete_packageCategories');
       // Delete related rows
       $packageCategory->packagesubCategories()->delete();

       // Delete the package category
       $packageCategory->delete();
   
       return response(["packageCategories deleted successfully"]);
     }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_packageCategories');

        PackageCategory::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected package categories deleted successfully"]);
    }
}

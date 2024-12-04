<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StorePackagesubCategoryRequest;
use App\Models\PackageCategory;
use App\Models\PackagesubCategory;
use Illuminate\Http\Request;

class PackagesubCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoriesPackage = PackageCategory::get();

         if ($request->ajax())
            return response(getModelData(model: new PackagesubCategory()));
        else
            return view('dashboard.packagesubCategories.index',compact('categoriesPackage'));
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
    public function store(StorePackagesubCategoryRequest $request)
    {
        $this->authorize('create_packagesubCategories');

        $data          = $request->validated();
      PackagesubCategory::create($data);

        return response(["PackagesubCategory created successfully"]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PackagesubCategory $packagesubCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PackagesubCategory $packagesubCategory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PackagesubCategory $packagesubCategory)
    {
        $this->authorize('update_packagesubCategories');

        $data = $request->validated();
        $packagesubCategory->update($data);

        return response(["Package Category updated successfully"]);
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PackagesubCategory $packagesubCategory)
    {
        $this->authorize('delete_packagesubCategories');
    
        $packagesubCategory->delete();
        return response(["packageSubCategory deleted successfully"]);
    }
    

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_packagesubCategories');

        PackageCategory::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected package categories deleted successfully"]);
    }
}

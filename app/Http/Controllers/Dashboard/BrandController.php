<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBrandRequest;
use App\Http\Requests\Dashboard\UpdateBrandRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_brands');
        if ($request->ajax())
            return response(getModelData(model: new Brand()));
        else
            return view('dashboard.brands.index');
    }

    public function store(StoreBrandRequest $request)
    {
        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Brands");

        $brand = Brand::create($data);

        return response(["brand created successfully"]);
    }

    public function update(UpdateBrandRequest $request, brand $brand)
    {
        $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "Brands");

        $brand->update($data);

        return response(["brand updated successfully"]);
    }

    public function destroy(brand $brand)
    {
        $this->authorize('delete_brands');
        $brand->delete();
        return response(["brand deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_brands');

        brand::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected brands deleted successfully"]);
    }
    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_brands');

        brand::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected brands restored successfully"]);
    }
}

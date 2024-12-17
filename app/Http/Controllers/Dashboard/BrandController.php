<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreBrandRequest;
use App\Http\Requests\Dashboard\UpdateBrandRequest;
use App\Models\award;
 use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        
        $this->authorize('view_awards');
        if ($request->ajax()){
      

            return response(getModelData(model: new award()));
        }
        else
            return view('dashboard.brands.index');
    }

    public function store(StoreBrandRequest $request)
    {

        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "awares");

        $brand = award::create($data);

        return response(["aware created successfully"]);
    }

    public function update(UpdateBrandRequest $request, award $brand)
    {
        $data = $request->validated();
        if ($request->has('image'))
            $data['image'] = uploadImageToDirectory($request->file('image'), "awares");

        $brand->update($data);

        return response(["aware updated successfully"]);
    }

    public function destroy(award $brand)
    {
        $this->authorize('delete_awards');
        $brand->delete();
        return response(["aware deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_awards');

        award::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected brands deleted successfully"]);
    }
    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_awards');

        award::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected brands restored successfully"]);
    }
}

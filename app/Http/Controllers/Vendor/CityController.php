<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\StoreCityRequest;
use App\Http\Requests\Vendor\UpdateCityRequest;
use App\Models\City;
use App\Models\CityProduct;
use App\Models\CityVendor;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CityController extends Controller
{
    public function index(Request $request)
    {
        if ($request->ajax())
        {
            $model = CityVendor::query()->whereVendorId(auth()->user()->id)->with('city');
            if ($request->search["value"])
            {
                $model->whereHas('city', function ($query) use ($request) {
                    return $query->where('name_ar', 'LIKE', "%" . $request->search["value"] . "%")->orWhere('name_en', 'LIKE', "%" . $request->search["value"] . "%");
                });
            }
            $response = [
                "recordsTotal" => $model->count(),
                "recordsFiltered" => $model->count(),
                'data' => $model->get()
            ];

            return response($response);
        } else
        {
            $cities = City::get();

            return view('vendor-dashboard.branches.index', compact('cities'));
        }
    }

    public function store(StoreCityRequest $request)
    {
        $vendor = auth()->user();

        $vendor->cities()->attach(['city_id' => $request->city_id]);
    }

    public function update(UpdateCityRequest $request, $city)
    {
        CityVendor::where('id', $city)->update($request->validated());
    }

    public function destroy($city)
    {
        CityVendor::where('id', $city)->delete();
        return response(["City deleted successfully"]);
    }


    public function deleteSelected(Request $request)
    {
        CityVendor::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected cities deleted successfully"]);
    }
    public function restoreSelected(Request $request)
    {
        CityVendor::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected cities restored successfully"]);
    }

    public function restore($id, Request $request)
    {
        if ($request->ajax())
            CityVendor::withTrashed()->find($id)->restore();
    }

    // public function deletedAttachedProductCities($city, $isFastShipping)
    // {
    //     if (CityProduct::whereCityId($city->city_id))
    //     {
    //         CityProduct::whereCityId($city->city_id)->delete();
    //     }
    // }
}

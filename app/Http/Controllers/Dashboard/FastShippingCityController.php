<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\FastCity;
use App\Models\CityProduct;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateCityRequest;
use App\Http\Requests\Dashboard\StoreFastShippingCityRequest;
use App\Http\Requests\Dashboard\UpdateFastShippingCityRequest;

class FastShippingCityController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_fast_cities');
        if ($request->ajax())
        {
            // $model = CityVendor::query()->whereVendorId(auth()->user()->id)->with('city');
            // if ($request->search["value"])
            // {
            //     $model->whereHas('city', function ($query) use ($request) {
            //         return $query->where('name_ar', 'LIKE', "%" . $request->search["value"] . "%")->orWhere('name_en', 'LIKE', "%" . $request->search["value"] . "%");
            //     });
            // }
            // if ($request->columns[2]['search']['value'] != null)
            // {
            //     $model->where('vendor_has_fast_shipping', $request->columns[2]['search']['value']);
            // }
            // $response = [
            //     "recordsTotal" => $model->count(),
            //     "recordsFiltered" => $model->count(),
            //     'data' => $model->get()
            // ];

            // return response($response);
            $fastShipment = getModelData(model: new FastCity(), relations: ['cities' => ['id', 'name_ar', 'name_en']]);

            return response()->json($fastShipment);
        } else
        {
            $cities = City::get();

            return view('dashboard.fast-shipping-city.index', compact('cities'));
        }
    }

    public function store(StoreFastShippingCityRequest $request)
    {
        $this->authorize('create_fast_cities');
        $data                      = $request->validated();
        $data['has_fast_shipping'] = true;
        FastCity::create($data);
        return response(["Fast shipping city created successfully"]);

    }

    public function update(UpdateFastShippingCityRequest $request, $city)
    {
        $this->authorize('update_fast_cities');
        $city = FastCity::find($city);
        $city->update($request->validated());
    }

    public function destroy($city)
    {
        $this->authorize('delete_fast_cities');

        $city = FastCity::find($city)->delete();
        return response(["City deleted successfully"]);
    }


    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_fast_cities');

        FastCity::whereIn('id', $request->selected_items_ids)->delete();
        return response(["selected cities deleted successfully"]);
    }


    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_fast_cities');
        FastCity::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected cities restored successfully"]);
    }

    public function restore($fastCity, Request $request)
    {
        $this->authorize('delete_fast_cities');
        if ($request->ajax())
            FastCity::withTrashed()->find($fastCity)->restore();
    }

}

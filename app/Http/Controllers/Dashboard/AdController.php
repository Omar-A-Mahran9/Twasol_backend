<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdRequest;
use App\Http\Requests\Dashboard\UpdateAdRequest;
use App\Models\Ad;
use App\Models\Vendor;
use Illuminate\Http\Request;

class AdController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_ads');
        $params = request()->all();

        if ($request->ajax()) {

            $ads = Ad::with([
                'vendor' => function ($query) {
                    $query->withTrashed()->select('id', 'name', 'description_ar', 'description_en', 'brand_name_en', 'brand_name_ar');
                }
            ]);

            $response = [
                "recordsTotal" => $ads->count(),
                "recordsFiltered" => $ads->count(),
                'data' => $ads->skip($params['start'])->take($params['length'])->get()
            ];
            return response($response);
        }
        $vendors = Vendor::select('id', 'name', 'description_ar', 'description_en', 'brand_name_en', 'brand_name_ar')->withTrashed()->get();

        return view('dashboard.ads.index', compact('vendors'));
    }

    public function store(StoreAdRequest $request)
    {
        $this->authorize('create_ads');

        $data          = $request->validated();
        $data['image'] = uploadImageToDirectory($request->file('image'), "Ads");

        Ad::create($data);

        return response(["Ad created successfully"]);
    }

    public function update(UpdateAdRequest $request, Ad $ad)
    {
        $this->authorize('update_ads');

        $data = $request->validated();
        if ($request->has('image'))
        
            $data['image'] = uploadImageToDirectory($request->file('image'), "Ads");
        $ad->update($data);

        return response(["Ad updated successfully"]);
    }

    public function show(Ad $ad)
    {
        $this->authorize('show_ads');

        $ad->load([
            'vendor' => function ($query) {
                $query->withTrashed()->select('id', 'name', 'description_ar', 'description_en');
            }
        ]);
        return view('dashboard.ads.show', compact('ad'));
    }

    public function destroy(Ad $ad)
    {
        $this->authorize('delete_ads');

        $ad->delete();

        return response(["Ad deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_ads');

        Ad::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected ads deleted successfully"]);
    }
}

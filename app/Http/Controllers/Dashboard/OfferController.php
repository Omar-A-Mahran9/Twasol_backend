<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreOfferRequest;
use App\Http\Requests\Dashboard\UpdateOfferRequest;
use App\Models\AddonService;
use App\Models\Category;
use App\Models\Offer;
use App\Models\Vendor;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_offers');
        $params = request()->all();

        if ($request->ajax())
        {
            $offers   = Offer::with([
                'service' => function ($query) {
                    $query->select('id', 'name_ar','name_en','description_ar','description_en');
                },
            ]);
            $response = [
                "recordsTotal" => $offers->count(),
                "recordsFiltered" => $offers->count(),
                'data' => $offers->skip($params['start'])->take($params['length'])->get()
            ];
            return response($response);
        }
        $Services    = AddonService::select('id', 'name_ar', 'name_en')->get();
 
        return view('dashboard.offers.index', compact('Services' ));
    }

    public function store(StoreOfferRequest $request)
    {
        $this->authorize('create_offers');

        $data = $request->validated();

        if ($request->has('image'))
        $data['image'] = uploadImageToDirectory($request->file('image'), "offers");

        Offer::create($data);

        return response(["Offer created successfully"]);
    }

    public function update(UpdateOfferRequest $request, Offer $offer)
    {
        $this->authorize('update_offers');

        $data = $request->validated();
        if ($request->has('image'))
        $data['image'] = uploadImageToDirectory($request->file('image'), "offers");

        $offer->update($data);

        return response(["Offer updated successfully"]);
    }

    public function show(Offer $offer)
    {
        $this->authorize('show_offers');

        $offer->load([
            'service' => function ($query) {
                $query->select('id', 'name_ar','name_en','description_ar','description_en');
            },
        ]);

        return view('dashboard.offers.show', compact('offer'));
    }

    public function destroy(Offer $offer)
    {
        $this->authorize('delete_offers');

        $offer->delete();

        return response(["Offer deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_offers');

        Offer::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected offers deleted successfully"]);
    }
}

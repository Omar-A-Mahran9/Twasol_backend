<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Vendor;
use Illuminate\Support\Str;
use App\Models\Subscription;
use App\Services\OTOService;
use Illuminate\Http\Request;
use App\Models\VendorShipment;
use App\Enums\VendorStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Events\VendorStatusChanged;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Dashboard\StoreVendorRequest;
use App\Http\Requests\Dashboard\UpdateVendorRequest;
use App\Http\Requests\Dashboard\StoreVendorShipmentDataRequest;
use App\Services\TapPaymentService;

class VendorController extends Controller
{

    private $otoService;
    private $tapPaymentService;

    public function __construct(OTOService $otoService, TapPaymentService $tapPaymentService)
    {
        $this->otoService = $otoService;
        $this->tapPaymentService = $tapPaymentService;
    }

    public function index(Request $request)
    {
        $this->authorize('view_vendors');

        if ($request->ajax()) {
            $relations = ['vendorShipment' => ['*']];

            $vendors = getModelData(model: new Vendor(), relations: $relations);

            return response()->json($vendors);
        }
        $subscriptions = Subscription::get();
        $statusEnum    = VendorStatusEnum::values();

        return view('dashboard.vendors.index', compact('subscriptions', 'statusEnum'));
    }

    public function create()
    {
        $this->authorize('create_vendors');
        return view('dashboard.vendors.create');
    }



    public function store(StoreVendorRequest $request)
    {
        $this->authorize('create_vendors');
        $data                        = $request->except('password_confirmation', 'ratio');
        $data['commercial_register'] = uploadImageToDirectory($request->file('commercial_register'), "Vendors");
        $data['licensure']           = uploadImageToDirectory($request->file('licensure'), "Vendors");
        $data['logo']                = uploadImageToDirectory($request->file('logo'), "Vendors");
        $data['cover']               = uploadImageToDirectory($request->file('cover'), "Vendors");
        $data['approved']            = false;
        $data['password'] = Hash::make(Str::random(10));
        $vendor = Vendor::create($data);
        $vendor->categories()->attach([
            1 => ['ratio' => $request->ratio[0]],
            2 => ['ratio' => $request->ratio[1]],
            3 => ['ratio' => $request->ratio[2]],
            4 => ['ratio' => $request->ratio[3]],
            5 => ['ratio' => $request->ratio[4]]
        ]);
        // $commercialRegister = $this->tapPaymentService->addFile('identity_document', 'commercial_register', $request->file('commercial_register'));
        // $licensure = $this->tapPaymentService->addFile('identity_document', 'licensure', $request->file('licensure'));
        // $logo = $this->tapPaymentService->addFile('business_logo', 'logo', $request->file('logo'));
        $dataTap = $this->tapPaymentService->addBusinessAccount($data);
        $vendor->update([
            'destination_id' => $dataTap['destination_id'],
            'business_id' => $dataTap['id'],
        ]);
        return response(["Vendor created successfully"]);
    }

    public function edit(Vendor $vendor)
    {
        $this->authorize('update_vendors');
        $vendor->load('categories');
        return view('dashboard.vendors.edit', compact('vendor'));
    }

    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        $this->authorize('update_vendors');

        $data = $request->except('password_confirmation', 'ratio');
        if ($request->has('commercial_register'))
            $data['commercial_register'] = uploadImageToDirectory($request->file('commercial_register'), "Vendors");
        if ($request->has('licensure'))
            $data['licensure'] = uploadImageToDirectory($request->file('licensure'), "Vendors");
        if ($request->has('logo'))
            $data['logo'] = uploadImageToDirectory($request->file('logo'), "Vendors");
        if ($request->has('cover'))
            $data['cover'] = uploadImageToDirectory($request->file('cover'), "Vendors");

        if (!$vendor->destination_id) {
            $dataTap =  $this->tapPaymentService->addBusinessAccount($data);
            $data['destination_id'] = $dataTap['destination_id'] ?? null;
            $data['business_id'] = $dataTap['business_id'] ?? null;
        }
        $vendor->update($data);
        $vendor->categories()->sync([
            1 => ['ratio' => $request->ratio[0]],
            2 => ['ratio' => $request->ratio[1]],
            3 => ['ratio' => $request->ratio[2]],
            4 => ['ratio' => $request->ratio[3]],
            5 => ['ratio' => $request->ratio[4]]
        ]);
        return response(["Vendor updated successfully"]);
    }

    public function show(Vendor $vendor)
    {
        $this->authorize('show_vendors');
        $vendor->load('categories');

        return view('dashboard.vendors.show', compact('vendor'));
    }

    public function destroy(Vendor $vendor)
    {
        $this->authorize('delete_vendors');

        $vendor->delete();

        return response(["Vendor deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_vendors');

        Vendor::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected vendors restored successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_vendors');

        Vendor::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected vendors deleted successfully"]);
    }

    public function createShippingDetails(Vendor $vendor)
    {
        $cities = City::get();
        return view('dashboard.vendors.shipping-details', compact('vendor', 'cities'));
    }

    public function editShippingDetails(Vendor $vendor)
    {
        $cities = City::get();
        $vendor->load('vendorShipment');
        return view('dashboard.vendors.edit-shipping-details', compact('vendor', 'cities'));
    }

    public function storeShippingDetails(StoreVendorShipmentDataRequest $request, Vendor $vendor)
    {
        $data         = $request->validated();
        $data['long'] = $data['lng'];
        unset($data['lng']);
        $data['google_map_url'] = "https://www.google.com/maps/?q=" . $request->lat . "," . $request->lng;
        $data['vendor_id']      = $vendor->id;
        $data['code']           = "code-" . VendorShipment::latest()->first()->id + 1;
        VendorShipment::create($data);

        return response(["Vendor shipment data created successfully"]);
    }



    public function updateShippingDetails(StoreVendorShipmentDataRequest $request, Vendor $vendor)
    {
        $data         = $request->validated();
        $data['long'] = $data['lng'];
        unset($data['lng']);
        $data['google_map_url'] = "https://www.google.com/maps/?q=" . $request->lat . "," . $request->lng;
        $data['vendor_id']      = $vendor->id;

        VendorShipment::create($data);

        return response(["Vendor shipment data updated successfully"]);
    }


    public function changeStatus(Vendor $vendor, Request $request)
    {

        if (!$vendor->vendorShipment && $request->status == 1) {

            abort_if(!$vendor->vendorShipment, 404, __("You must add shipping details first"));
        } else {

            $vendor->update([
                'approved' => $request->status
            ]);

            //Fire email to inform vendor by his details
            if ($vendor->approved) {
                $token = Str::random(60);
                DB::table('password_reset_tokens')->insert([
                    'email' => $vendor->email,
                    'token' => Hash::make($token),
                    'created_at' => now(),
                ]);
                $resetLink = route('new.password', ['token' => $token]);
                event(new VendorStatusChanged($vendor, $vendor->approved, $resetLink));
            }
        }
        return response(["Vendor updated successfully"]);
    }

    public function restore($vendor, Request $request)
    {
        $this->authorize('delete_vendors');
        if ($request->ajax())
            Vendor::withTrashed()->find($vendor)->restore();
    }
}

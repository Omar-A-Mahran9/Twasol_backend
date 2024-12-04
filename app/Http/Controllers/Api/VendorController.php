<?php

namespace App\Http\Controllers\Api;

use App\Enums\VendorStatusEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreVendorRequest;
use App\Http\Resources\Api\ProductResource;
use App\Http\Resources\Api\VendorResource;
use App\Models\Vendor;
use App\Traits\WebNotificationsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VendorController extends Controller
{
    use WebNotificationsTrait;
    public function index(Request $request)
    {
        $query = Vendor::query();
        $query->when($request->city_id, function ($query) use ($request) {
            $query->whereHas('cities', function ($q) use ($request) {
                $q->where('city_id', $request->city_id);
            });
        });
        $vendors = $query->with('products')->get();

        return $this->success('', VendorResource::collection($vendors));
    }

    public function show(Request $request, Vendor $vendor)
    {
        $vendor->load('products');
        return $this->success('', new VendorResource($vendor));
    }

    public function vendorProducts(Request $request, Vendor $vendor)
    {
        $query = $vendor->products();

        $query->when($request->category_id, function ($query) use ($request) {
            $query->whereHas('categories', function ($q) use ($request) {
                $q->where('category_id', $request->category_id);
            });
        });

        $query->when($request->brand_id, function ($query) use ($request) {
            $query->where('brand_id', $request->brand_id);
        });

        $products = $query->paginate(8);

        return $this->successWithPagination("", ProductResource::collection($products)->response()->getData(true));
    }

    public function store(StoreVendorRequest $request)
    {
        $data                 = $request->except('password_confirmation');
        $data['privacy_flag'] = $data['privacy_flag'] ? 1 : 0;
        $data['approved'] = VendorStatusEnum::Pending->value;
        $data['password']= Hash::make(Str::random(10));
        $vendor = Vendor::create($data);
        $this->newVendorNotification($vendor);
        return $this->success(__('Vendor has been registered successfully'));
    }
}

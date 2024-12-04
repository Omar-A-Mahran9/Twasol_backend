<?php

namespace App\Http\Controllers\Vendor;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vendor\UpdateProfileEmailRequest;
use App\Http\Requests\Vendor\UpdateProfileInfoRequest;
use App\Http\Requests\Vendor\UpdateProfilePasswordRequest;
use App\Models\City;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class VendorController extends Controller
{
    public function profileInfo()
    {
        $vendor = auth()->user()->load('cities')->loadCount(['orderItems' => function($query) {
            $query->whereFastShipping(TRUE);
        }]);
        $query = Order::query()->where('status', OrderStatus::Delivered->value)->whereHas('orderItems', function($q){
            $q->where('vendor_id', auth()->user()->id);
        });
        $allOrders = Order::whereHas('orderItems', function($q){
            $q->where('vendor_id', auth()->user()->id);
        })->count();

        $totalOrdersPrice = $query->clone()->sum('total_price');
        $completedOrdersPercentageRate = $allOrders ? ( $query->clone()->count() / $allOrders ) * 100 : 0;

        return view('vendor-dashboard.profile-info', compact('vendor', 'totalOrdersPrice', 'completedOrdersPercentageRate'));
    }

    public function updateProfileInfo(UpdateProfileInfoRequest $request)
    {
        $vendor = auth()->user();
        $dataAttachedWithProduct = $request->toArray();
        $dataAttachedWithVendor = $dataAttachedWithProduct;
        if($request->logo)
        {
            $dataAttachedWithVendor['logo'] = uploadImageToDirectory($dataAttachedWithVendor['logo'], 'vendor');
        }
        if($request->cover)
        {
            $dataAttachedWithVendor['cover'] = uploadImageToDirectory($dataAttachedWithVendor['cover'], 'vendor');
        }
        if($request->commercial_register)
        {
            $dataAttachedWithVendor['commercial_register'] = uploadImageToDirectory($dataAttachedWithVendor['commercial_register'], 'vendor');
        }
        if($request->licensure)
        {
            $dataAttachedWithVendor['licensure'] = uploadImageToDirectory($dataAttachedWithVendor['licensure'], 'vendor');
        }

        $vendor->update($dataAttachedWithVendor);
    }

    public function updateProfileEmail(UpdateProfileEmailRequest $request)
    {
        $vendor = auth()->user();

        $data = $request->validated();

        $vendor->update([
            'email' => $data['email']
        ]);
    }

    public function updateProfilePassword(UpdateProfilePasswordRequest $request)
    {
        $vendor = auth()->user();

        $data = $request->validated();

        $vendor->update($data);
    }
}

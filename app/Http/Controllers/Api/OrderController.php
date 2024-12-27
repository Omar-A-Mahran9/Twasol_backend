<?php

namespace App\Http\Controllers\Api;

use App\Models\City;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\Address;
use App\Models\Product;
use App\Models\Customer;
use App\Models\FastCity;
use App\Models\OrderItem;
use App\Enums\OrderStatus;
use App\Models\CityVendor;
use App\Models\OrderReason;
use Illuminate\Support\Str;
use App\Services\OTOService;
use Illuminate\Http\Request;
use App\Services\TapPaymentService;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;
use App\Traits\WebNotificationsTrait;
use App\Http\Resources\Api\CityResource;
 use App\Http\Resources\Api\OrderResource;
use App\Http\Resources\Api\ReasonResource;
use App\Http\Requests\Api\OrderReasonRequest;
 
use App\Http\Requests\Api\OrderRequest;
 
class OrderController extends Controller
{
    use WebNotificationsTrait;
    private $tapPaymentService;
    private $otoService;

    public function __construct(TapPaymentService $tapPaymentService, OTOService $otoService)
    {
        $this->tapPaymentService = $tapPaymentService;
        $this->otoService        = $otoService;
    }
 

    public function createOrder(OrderRequest $request)
    {
        $data = $request->validated();
        
        // If no addon service ID, return an error response or success message
        if ($request->addon_service_id == null) {
            return response()->json( $data );
        }
    
        // Create customer
        $customerData = [
            'first_name' => strtok($data['name'], ' '),
            'last_name' => trim(strtok(' ')),
            'phone' => $data['phone'],
            'email' => $data['email'],
            'block_flag' => 0,
        ];
        $customer = Customer::create($customerData);
    
        // Create order
        $orderData = [
            'customer_id' => $customer->id,
            'city_id' => $data['city_id'],
            'address' => $data['address'],
            'date' => $data['date'] ?? "",
            'addon_service_id' => $data['addon_service_id'],
            'description' => $data['description'],
        ];
    
        $order = Order::create($orderData);
    
        return response()->json($order, 201);  // Respond with the created order
    }
    

    public function checkPaymentTransaction(Request $request)
    {
        $request->validate([
            'tap_id' => ['required'],
        ]);

        return $this->tapPaymentService->retrieveCharge($request->tap_id);
    }

    public function dataOrder($id, $vendors)
    {
        $orderItems   = [];
        $orderVendors = collect();
        $total        = 0;
        $tax          = 0;

        foreach ($vendors as $key => $vendor) {
            $order = Order::with([
                'customer',
                'address.city',
                'orderItems' => function ($query) use ($vendor) {
                    $query->where('vendor_id', $vendor['id']);
                }
            ])->findOrFail($id);

            $vendorShipment  = Vendor::with('vendorShipment.city')->find($vendor['id'])->vendorShipment;
            $shipmentDetails = [
                "name" => $vendorShipment->name,
                "code" => $vendorShipment->code,
                "mobile" => $vendorShipment->phone,
                "city" => $vendorShipment->city->name_en,
                "country" => $vendorShipment->country_code,
                "address" => $vendorShipment->street_address,
                "contactName" => $vendorShipment->contact_name,
                "contactEmail" => $vendorShipment->contact_email,
                "lat" => $vendorShipment->lat,
                "lon" => $vendorShipment->long
            ];
            $total           = 0;
            $tax             = 0;
            foreach ($order->orderItems as $key => $item) {

                $total += $item->price;
                $tax += $item->price * (setting('tax') / 100);
                $orderItems[$key] = ["name" => $item->product->name, "price" => $item->price, "taxAmount" => 15, "quantity" => $item->quantity, 'sku' => $vendorShipment->code . '-' . $item->product->name];
            }
            $orderId      = rand(11, 99);
            $orderDetails = [
                "orderId" => $orderId,
                "parentOrderId" => $order->id,
                "pickupLocationCode" => $vendorShipment->code,
                "storeName" => "Platin",
                "payment_method" => $order->paying_off == 2 ? "paid" : "cod",
                "amount" => $total + $vendor['delivery']['price'] + $tax,
                "subtotal" => $total,
                "shippingAmount" => $vendor['delivery']['price'],
                "amount_due" => $order->paying_off == 2 ? 0 : $total + $vendor['delivery']['price'] + $tax,
                "currency" => "SAR",
                "createShipment" => false,
                // "createShipment" => true,
                "deliveryOptionId" => $vendor['delivery']['deliveryOptionId'],
                "customer" => [
                    "name" => $order->gift_owner_name ?? $order->customer->first_name . " " . $order->customer->last_name,
                    "email" => $order->customer->email,
                    "mobile" => $order->gift_owner_phone ?? $order->customer->phone,
                    // "address" => $vendorShipment->street_address,
                    // "city" => $vendorShipment->city,
                    // "country" => $vendorShipment->country_code
                    "address" => $order->address->street_name . " " . $order->address->district . " " . $order->address->building_number,
                    "city" => $order->address->city->name_en,
                    "country" => $vendorShipment->country_code,
                    "district" => $order->address->district ?? null,
                    // "lat"=>,
                    // "lon"=>,
                    // "postcode"=>,
                ],
                "items" => $orderItems
            ];
            // $orderVendors->add(['shipmentDetails' => $shipmentDetails, 'orderDetails' => $orderDetails]);
            $this->otoService->createOrder($shipmentDetails, $orderDetails);
            // dd($serviceOrder);

        }
        // dd($orderVendors);

        // return $this->success(__('Your request has been created successfully'), [$orderVendors]);
        return $orderVendors;
    }
    public function cities(Request $request)
    {
        $request->validate([
            'products' => ['required'],
            'products.*' => ['required'],
        ]);
        // $productsCollect = collect($request->products);
        // $vendorIds       = $productsCollect->pluck('vendor_id')->unique();
        // $cities          = CityVendor::with('city')->whereIn('vendor_id', $vendorIds)->where('vendor_has_fast_shipping', true)->get();
        // if ($vendorIds->count() === 1)
        // {
        //     $resultCities = $cities->pluck('city')->unique();
        // } else
        // {

        //     $commonCities = $cities->groupBy('city_id')
        //         ->filter(function ($group) {
        //             return $group->pluck('vendor_id')->unique()->count() > 1;
        //         })
        //         ->map(function ($group) {
        //             return $group->first()->city;
        //         });
        //     $resultCities = $commonCities;
        // }
        $allCities = City::get();

        return $this->success(
            '',
            CityResource::collection($allCities)
        );
    }
    function appendOrUpdate($collection, $newEntry)
    {
        $existingEntry = $collection->firstWhere('id', $newEntry['id']);

        if ($existingEntry) {
            $collection->transform(function ($item) use ($newEntry) {
                if ($item['id'] === $newEntry['id']) {
                    $item['amount'] += $newEntry['amount']; // Add new amount to existing amount
                }
                return $item;
            });
        } else {
            $collection->push($newEntry);
        }
    }

    function orderBy()
    {
        $customer = auth()->user()->id;
        $orders = Order::with('orderItems.product.images', 'address.city')->where('customer_id', $customer)->get();
        return $this->success(
            '',
            OrderResource::collection($orders)
        );
    }

    function trackOrder(Request $request)
    {
        $order = [];
        $query = Order::query()->with('orderItems.product.images', 'address.city');
        if ($request->search) {

            $query->Where('id', $request->search);
            // if ($request->status == 1) { // Current order: all orders not delivered
            //     $query->where('status', '!=', OrderStatus::Delivered->value);
            // } elseif ($request->status == 2) { // Delivered orders
            //     $query->where('status', OrderStatus::Delivered->value);
            // }

            $order = $query->first();
        }
        if ($order == null) {
            $order = [];
        }
        return $this->success(
            '',
            $order ? new OrderResource($order) : []
        );
    }

    function orderReason(OrderReasonRequest $request, $type)
    {
        $order = Order::find($request->order_id);
        if ($type == 'cancel') {
            $order->update([
                'status' => OrderStatus::Canceled->value
            ]);
        } else if ($type == 'refund') {
            $order->update([
                'status' => OrderStatus::Refund->value
            ]);
        }
        $order->reasons()->attach($request->order_reason_id);
        $this->CancelRefundOrderNotification($order);
        return $this->success(
            'Created successfully',
            []
        );
    }

    function reason(Request $request)
    {
        $reasons = OrderReason::where('type', $request->type)->get();
        return $this->success(
            'Created successfully',
            ReasonResource::collection($reasons)
        );
    }
}

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
use App\Http\Requests\Api\PaymentRequest;
use App\Http\Resources\Api\OrderResource;
use App\Http\Resources\Api\ReasonResource;
use App\Http\Requests\Api\OrderReasonRequest;
use App\Http\Requests\Api\OrderCheckoutRequest;

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

    public function checkout(OrderCheckoutRequest $request, $step = null)
    {
        $vendors = collect();
        if ($step == 1) {
            $unavailableProductsForFastShipping = collect();
            $unavailableProductsShipping        = collect();
            $allProductsInSameCity              = true;
            $totalShippingCost                  = 0;
            $vendorCityShippingCosts            = [];
            $message                            = '';
            $splitPriceVendor = collect();
            $priceSpecification = 0;
            $priceAfterVat = 0;
            if (request()->fast_shipping) {
                foreach (request()->products as $key => $item) {
                    // Fetch the product once based on vendor_id and item_id
                    $product = Product::with('categories', 'vendor.categories')->where('vendor_id', $item['vendor_id'])->whereHas('specifications', function ($query) use ($item) {
                        $query
                            // ->where('stock', '>', '0')
                            ->where('product_id', $item['id'])
                            ->where('weight', $item['weight'])
                            ->where('size', $item['size']);
                    })->find($item['id']);
                    if ($product) {
                        $cityId = request()->city;
                        $hasStock = $product->specifications()
                            ->where('product_id', $item['id'])
                            ->where('stock', '<=', 0)
                            ->exists();
                        // Check if product doesn't have the specified city
                        $hasCity = $product->cities()->where('city_id', $cityId)->exists();
                        if (!$hasCity) {
                            if ($hasStock) {
                                $message = __('Product is out of stock.');
                                $unavailableProductsForFastShipping->add([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $item['price'],
                                    'quantity' => $item['quantity'],
                                    'image' => $product->images()->first()->full_image_path ?? null
                                ]);
                            } else {
                                $unavailableProductsForFastShipping->add([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $item['price'],
                                    'quantity' => $item['quantity'],
                                    'image' => $product->images()->first()->full_image_path ?? null
                                ]);
                                $allProductsInSameCity = false;
                                $message               = __('There is no express shipping to') . ' ' . City::find(request()->city)->name;
                            }
                        } else {
                            $vendorHasFastShipping = $product->cities()
                                ->whereHas('fastShipping', function ($query) use ($cityId) {
                                    $query->where('city_id', $cityId);
                                })->with([
                                    'fastShipping' => function ($query) use ($cityId) {
                                        $query->where('city_id', $cityId);
                                    }
                                ])->first();

                            if ($vendorHasFastShipping) {
                                $shippingPrice = $vendorHasFastShipping->fastShipping->shipping_price;

                                // If this vendor-city combination has not been added yet
                                if (!isset($vendorCityShippingCosts[$cityId])) {
                                    $totalShippingCost += $shippingPrice;
                                    $vendorCityShippingCosts[$cityId] = $shippingPrice;
                                }
                            }
                            if (!$vendorHasFastShipping) {
                                $unavailableProductsForFastShipping->add([
                                    'id' => $product->id,
                                    'name' => $product->name,
                                    'price' => $item['price'],
                                    'quantity' => $item['quantity'],
                                    'image' => $product->images()->first()->full_image_path ?? null
                                ]);
                                $allProductsInSameCity = false;
                                $message               = __('No fast shipping');
                            }
                        }
                        $filteredCategories = $product->vendor->categories->filter(function ($vendorCategory) use ($product) {
                            return $vendorCategory->id === $product->categories->first()->id;
                        });
                        $firstCategory = $filteredCategories->first();
                        $ratio = optional($firstCategory?->pivot)->ratio ?? 0;
                        $priceAfterVat = $item['price'] + ($item['price'] * (setting('tax') / 100));

                        $priceSpecification = $priceAfterVat - ($priceAfterVat *  ($ratio / 100));
                        $this->appendOrUpdate($splitPriceVendor, [
                            "id" => $product->vendor['destination_id'], //destination id
                            "amount" => $priceSpecification,
                            "currency" => "SAR"
                        ]);
                    }
                }
                if (!$allProductsInSameCity) {
                    return response([
                        'message' => $message,
                        'data' => [
                            'unavailableProducts' => $unavailableProductsForFastShipping,
                            'totalShippingCost' => $totalShippingCost
                        ]
                    ], 200);
                }
                return response([
                    'message' => __('Successfully completed'),
                    'data' => [
                        'unavailableProducts' => $unavailableProductsForFastShipping,
                        'totalShippingCost' => $totalShippingCost,
                        "destination" => $splitPriceVendor
                    ]
                ], 200);
            } elseif (!request()->fast_shipping) {
                foreach (request()->products as $key => $item) {
                    $product = Product::with('categories', 'vendor.categories', 'vendor.vendorShipment.city')->where('vendor_id', $item['vendor_id'])->whereHas('specifications', function ($query) use ($item) {
                        $query
                            // ->where('stock', '>', '0')->where('product_id', $item['id'])
                            ->where('weight', $item['weight'])
                            ->where('size', $item['size']);
                    })->find($item['id']);
                    $city    = City::find($request->city);
                    if ($product) {
                        $hasStock = $product->specifications()
                            ->where('product_id', $item['id'])
                            ->where('stock', '<=', 0)
                            ->exists();
                        if ($hasStock) {
                            $message = __('Product is out of stock.');
                            $unavailableProductsShipping->add([
                                'id' => $item['id'],
                                'name' => $product['name'],
                                'price' => $item['price'],
                                'quantity' => $item['quantity'],
                                'image' => $product->images()->first()->full_image_path ?? null
                            ]);
                        } else {
                            $filteredCategories = $product->vendor->categories->filter(function ($vendorCategory) use ($product) {
                                return $vendorCategory->id === $product->categories->first()->id;
                            });
                            $firstCategory = $filteredCategories->first();
                            $ratio = optional($firstCategory?->pivot)->ratio ?? 0;
                            $priceAfterVat = $item['price'] + ($item['price'] * (setting('tax') / 100));
                            $priceSpecification = $priceAfterVat - ($priceAfterVat *  ($ratio / 100));
                            $this->appendOrUpdate($splitPriceVendor, [
                                "id" => $product->vendor['destination_id'], //destination id
                                "amount" => $priceSpecification,
                                "currency" => "SAR"
                            ]);
                            $vendors->add([
                                'id' => $product->vendor->id,
                                'city' => $product->vendor->vendorShipment->city->name_en,
                                'vendor_name' => $product->vendor['name'],
                                'product_id' => $product['id'],
                                'name' => $product['name'],
                                'price' => $item['price'],
                                'quantity' => $item['quantity'],
                                'image' => $product->images()->first()->full_image_path ?? null
                            ]);
                        }
                    }
                }
                $uniqueVendors = $vendors->unique('id')->values()->toArray();
                foreach ($uniqueVendors as $index => $uniqueVendor) {
                    $dataDelivery = [
                        'weight' => 1,
                        'originCity' => $uniqueVendor['city'],
                        'destinationCity' => $city->name_en
                    ];

                    $delivery = $this->otoService->checkDeliveryFee($dataDelivery);
                    if (count($delivery->deliveryCompany) == 0) {
                        $message = __('No shipping to city') . ' ' . $city->name;
                        $matches = $vendors->Where('id', $uniqueVendor['id']);
                        $matches->each(function ($match) use ($unavailableProductsShipping, $product) {
                            $unavailableProductsShipping->add([
                                'id' => $match['product_id'],
                                'name' => $match['name'],
                                'price' => $match['price'],
                                'quantity' => $match['quantity'],
                                'image' => $product->images()->first()->full_image_path ?? null
                            ]);
                        });
                    }
                    if ($delivery->success) {
                        $deliveryCompanies = collect($delivery->deliveryCompany);
                        // Filter for freePickup first, then for freePickupDropoff if no freePickup options found
                        $filteredDelivery = $deliveryCompanies->filter(function ($company) {
                            return $company->pickupDropoff === 'freePickup';
                        });
                        if ($filteredDelivery->isEmpty()) {
                            $filteredDelivery = $deliveryCompanies->filter(function ($company) {
                                return $company->pickupDropoff === 'freePickupDropoff';
                            });
                        }
                        // Find the delivery option with the minimum price
                        $minPriceDelivery = $filteredDelivery->sortBy('price')->first();
                        if ($minPriceDelivery) {
                            $totalShippingCost += $minPriceDelivery->price;
                            // Update the uniqueVendor array with delivery info
                            $uniqueVendors[$index]['delivery'] = $minPriceDelivery;
                        }
                    } elseif ($delivery->errorCode == 3) {
                        $matches = $vendors->Where('id', $uniqueVendor['id']);
                        $matches->each(function ($match) use ($unavailableProductsShipping, $product) {
                            $unavailableProductsShipping->add([
                                'id' => $match['product_id'],
                                'name' => $match['name'],
                                'price' => $match['price'],
                                'quantity' => $match['quantity'],
                                'image' => $product->images()->first()->full_image_path ?? null
                            ]);
                        });
                    }
                }
                return response([
                    'message' => $message,
                    'data' => [
                        'unavailableProducts' => $unavailableProductsShipping,
                        'totalShippingCost' => $totalShippingCost,
                        "unique_vendors" => $uniqueVendors,
                        "destination" => $splitPriceVendor
                    ]
                ], 200);
            }
        }

        if (!isset($step)) {
            $customer = Customer::where('email', $request->email)->orWhere('phone', $request->phone)->first();
            if (!$customer) {
                $customer = Customer::create([
                    "first_name" => $request->first_name,
                    "last_name" => $request->last_name,
                    "phone" => $request->phone,
                    "email" => $request->email,
                    "bloc_flag" => 0
                ]);
            }

            $address            = Address::create([
                'customer_id' => $customer->id,
                'city_id' => $request->city,
                'street_name' => $request->street_name,
                'building_number' => $request->building_number,
                'district' => $request->district,
                'marks' => $request->marks,
                'lat' => $request->lat,
                'lng' => $request->lng,
            ]);
            $collectionShipment = collect($request->unique_vendors);
            $shippingPrice      = 0;
            if ($collectionShipment->isNotEmpty()) {
                $shippingPrice = $collectionShipment->pluck('delivery.price')->sum();
            } else {
                $shippingPrice = FastCity::where('city_id', request()->city)->first()->shipping_price ?? 0;
            }
            $total = collect($request->products)->sum(callback: 'price') * (setting('tax') / 100) + collect($request->products)->sum('price');
            $order = Order::create([
                "customer_id" => $customer->id,
                "address_id" => $address->id,
                "total_price" => $total + $shippingPrice,
                "tax" => $request->tax ?? 0,
                "type" => $request->type,
                "gift_owner_name" => $request->gift_owner_name,
                "gift_owner_phone" => $request->gift_owner_phone,
                "gift_text" => $request->gift_text,
                "paying_off" => $request->paying_off,
                "has_fast_shipping" => $request->fast_shipping ?? 0,
                "shipping_price" => $shippingPrice,
                "city_id" => $request->city
            ]);

            $splitPriceVendor = collect();
            $priceSpecification = 0;
            foreach ($request->products as $product) {
                $isFastShippingProduct = Product::where('vendor_id', $product['vendor_id'])->whereHas('cities', function ($q) use ($request) {
                    $q->whereHas('fastShipping', function ($query) use ($request) {
                        $query->where('city_id', $request->city);
                    });
                })->where('id', $product['id'])->exists();
                $productExist = Product::where('vendor_id', $product['vendor_id'])->whereHas('specifications', function ($query) use ($product) {
                    $query->where('product_id', $product['id'])
                        ->where('weight', $product['weight'])
                        ->where('size', $product['size']);
                })->find($product['id']);
                if ($productExist) {
                    $productStock = ProductSpecification::where('price', $product['price'])
                        ->where('product_id', $product['id'])
                        ->where('weight', $product['weight'])
                        ->where('size', $product['size'])->first();
                    if ($productStock) {
                        $productStock->update([
                            'stock' => $productStock->stock - $product['quantity']
                        ]);
                    }
                }
                OrderItem::create([
                    "order_id" => $order->id,
                    "product_id" => $product['id'],
                    "vendor_id" => $product['vendor_id'],
                    "price" => $product['price'],
                    "quantity" => $product['quantity'],
                    "size" => $product['size'],
                    "weight" => $product['weight'],
                    "tax" => setting('tax'),
                    "fast_shipping" => $isFastShippingProduct ? TRUE : FALSE
                ]);
            }
            if ($request->unique_vendors) {
                $this->dataOrder($order->id, $request->unique_vendors);
            }
            $this->newOrderNotification($order);
            $this->newOrderVendorNotification($order);

            return $this->success("Created successfully", new OrderResource($order));
        }
    }

    public function pay(PaymentRequest $request)
    {
        return $this->tapPaymentService->pay($request);
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

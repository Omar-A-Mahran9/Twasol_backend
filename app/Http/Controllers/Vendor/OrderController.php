<?php

namespace App\Http\Controllers\Vendor;

use App\Models\City;
use App\Models\Order;
use App\Models\ProductSpecification;
use App\Models\Vendor;
use App\Models\HistoryOrder;
use App\Services\OTOService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    private $otoService;

    public function __construct(OTOService $otoService)
    {
        $this->otoService = $otoService;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $model = Order::query()->whereHas('orderItems', function ($query) {
                $query->where('vendor_id', auth()->user()->id);
            })->with('customer')
                ->select('orders.*', \DB::raw('(SELECT SUM(price) FROM order_items WHERE order_items.order_id = orders.id AND order_items.vendor_id = ' . auth()->user()->id . ') as total_price'));

            if ($request->search["value"]) {
                $model->whereHas('customer', function ($query) use ($request) {
                    $query->where('first_name', 'LIKE', "%" . $request->search["value"] . "%")->orWhere('last_name', 'LIKE', "%" . $request->search["value"] . "%");
                })->orWhere('total_price', 'LIKE', "%" . $request->search["value"] . "%")->orWhere('created_at', 'LIKE', "%" . $request->search["value"] . "%");
            }
            if ($request->columns[3]['search']['value'] != null) {
                $model->where('status', $request->columns[3]['search']['value']);
            }
            $response = [
                "recordsTotal" => $model->count(),
                "recordsFiltered" => $model->count(),
                'data' => $model->get()
            ];

            return response($response);
        }

        return view("vendor-dashboard.orders.index");
    }

    public function show(Order $order)
    {
        $order->load("customer", "address.city", "historyOrder");
        $order->load([
            "orderItems" => function ($query) {
                $query->where('vendor_id', auth()->user()->id);
                $query->with([
                    'product' => function ($query) {
                        $query->withTrashed();  // Include trashed products
                    }
                ]);
            }
        ]);
        return view("vendor-dashboard.orders.show", compact("order"));
    }

    public function changeOrderStatus(string $id, Request $request)
    {
        $order           = Order::with('customer', 'orderItems')->findOrFail($id);
        $orderItems      = [];
        $vendorID        = auth()->user()->id;
        $vendorShipment  = Vendor::with('vendorShipment')->find($vendorID)->vendorShipment;
        $shipmentDetails = [
            "name" => $vendorShipment->name,
            "code" => $vendorShipment->code,
            "mobile" => $vendorShipment->phone,
            "city" => $vendorShipment->city,
            "country" => $vendorShipment->country_code,
            "address" => $vendorShipment->street_address,
            "contactName" => $vendorShipment->contact_name,
            "contactEmail" => $vendorShipment->contact_email,
            "lat" => $vendorShipment->lat,
            "lon" => $vendorShipment->long
        ];

        foreach ($order->orderItems as $key => $item) {
            $orderItems[$key] = ["name" => $item->product->name, "price" => $item->price, "quantity" => $item->quantity, 'sku' => $vendorShipment->code . '-' . $item->product->name];
        }

        $orderDetails = [
            "orderId" => $order->id,
            "pickupLocationCode" => $vendorShipment->code,
            "storeName" => "Platin",
            "payment_method" => "paid",
            "amount" => $order->total_price,
            "amount_due" => 0,
            "currency" => "SAR",
            "createShipment" => false,
            "customer" => [
                "name" => $order->customer->first_name . " " . $order->customer->last_name,
                "email" => $order->customer->email,
                "mobile" => $order->customer->phone,
                "address" => $vendorShipment->street_address,
                "city" => $vendorShipment->city,
                "country" => $vendorShipment->country_code
            ],
            "items" => $orderItems
        ];

        // dd($this->otoService->createOrder($shipmentDetails, $orderDetails));
        if ($request->status == 6) {
            foreach ($order->orderItems as $product) {
                $productStock = ProductSpecification::where('price', $product['price'])
                    ->where('product_id', $product['product_id'])
                    ->where('weight', $product['weight'])
                    ->where('size', $product['size'])->first();
                $productStock->update(['stock' => $productStock['stock'] + $product['quantity']]);
            }
        }
        $order->update([
            "status" => $request->status
        ]);
        HistoryOrder::create([
            "order_id" => $id,
            "vendor_id" => auth()->user()->id,
            "status" => $request->status
        ]);
        return redirect()->route('vendor.orders.show', $order->id);
    }
}

<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\City;
use App\Models\Order;
use App\Models\Vendor;
use App\Models\HistoryOrder;
use App\Services\OTOService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ProductSpecification;

class OrderController extends Controller
{


    public function index(Request $request)
    {
        $this->authorize('view_orders');

        if ($request->ajax()) {
            $model = Order::query()->with('customer', 'reasons');
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

        return view("dashboard.orders.index");
    }

    public function show(Order $order)
    {
        $this->authorize('show_orders');
        $order->load([
            'customer',
            'address.city',
            'historyOrder',
            'orderItems' => function ($query) {
                $query->with([
                    'product' => function ($query) {
                        $query->withTrashed();  // Include trashed products
                    }
                ]);
            }
        ]);
        return view("dashboard.orders.show", compact("order"));
    }

    public function changeOrderStatus(string $id, Request $request)
    {
        $order = Order::with('customer', 'orderItems')->findOrFail($id);
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
            'admin_id' => auth()->user()->id,
            "status" => $request->status
        ]);
        return redirect()->route('dashboard.orders.show', $order->id);
    }
}

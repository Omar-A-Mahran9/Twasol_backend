<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Role;
use App\Models\Admin;
use App\Models\OrderReason;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreAdminRequest;
use App\Http\Requests\Dashboard\UpdateAdminRequest;
use App\Http\Requests\Dashboard\StoreOrderReasonRequest;
use App\Http\Requests\Dashboard\UpdateOrderReasonRequest;

class OrderReasonController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_order_reasons');

        if ($request->ajax()) {
            $data = getModelData(model: new OrderReason());
            return response()->json($data);
        }

        return view('dashboard.order-reasons.index');
    }

    public function store(StoreOrderReasonRequest $request)
    {
        $data = $request->validated();
        OrderReason::create($data);
    }

    public function update(UpdateOrderReasonRequest $request, OrderReason $reason)
    {
        $data = $request->validated();
        $reason->update($data);
    }

    public function destroy(Request $request, $reason)
    {
        $this->authorize('delete_order_reasons');
        if ($request->ajax())
            OrderReason::find($reason)->delete();
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_order_reasons');
        OrderReason::whereIn('id', $request->selected_items_ids)->delete();
        return response(["selected order reason deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_order_reasons');
        OrderReason::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected order reason restored successfully"]);
    }
}

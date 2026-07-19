<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreLeaveTypeRequest;
use App\Http\Requests\Dashboard\UpdateLeaveTypeRequest;
use App\Http\Requests\StoreLeaveTypeRequest as RequestsStoreLeaveTypeRequest;
use App\Models\LeaveType;
use Illuminate\Http\Request;

class LeaveTypeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_leave_types');

        if ($request->ajax()) {

            $data = getModelData(
                model: new LeaveType()
            );

            return response()->json($data);
        }

        return view('dashboard.leave_types.index');
    }

    public function store(RequestsStoreLeaveTypeRequest $request)
    {
         $this->authorize('create_leave_types');

        $data = $request->validated();

        LeaveType::create($data);

        return response([
            'message' => __('Leave type created successfully')
        ]);
    }

    public function update(
        UpdateLeaveTypeRequest $request,
        LeaveType $leaveType
    ) {
        $this->authorize('update_leave_types');

        $data = $request->validated();

        $leaveType->update($data);

        return response([
            'message' => __('Leave type updated successfully')
        ]);
    }

    public function destroy(LeaveType $leaveType)
    {
        $this->authorize('delete_leave_types');

        $leaveType->delete();

        return response([
            'message' => __('Leave type deleted successfully')
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_leave_types');

        LeaveType::whereIn(
            'id',
            $request->selected_items_ids
        )->delete();

        return response([
            'message' => __('Selected leave types deleted successfully')
        ]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_leave_types');

        LeaveType::withTrashed()
            ->whereIn(
                'id',
                $request->selected_items_ids
            )
            ->restore();

        return response([
            'message' => __('Selected leave types restored successfully')
        ]);
    }
}

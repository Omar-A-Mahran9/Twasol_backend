<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreDesignTypeRequest;
use App\Http\Requests\Dashboard\UpdateDesignTypeRequest;
use App\Models\DesignType;
use Illuminate\Http\Request;

class DesignTypeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_design_types');

        if ($request->ajax())
        {
            $designTypes = getModelData(model: new DesignType());

            return response()->json($designTypes);
        }

        return view('dashboard.design-types.index');
    }

    public function store(StoreDesignTypeRequest $request)
    {
        DesignType::create($request->validated());

        return response(["Design type created successfully"]);
    }

    public function update(UpdateDesignTypeRequest $request, DesignType $designType)
    {
        $designType->update($request->validated());

        return response(["design type updated successfully"]);
    }

    public function destroy(DesignType $designType)
    {
        $this->authorize('delete_design_types');

        $designType->delete();

        return response(["design type deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_design_types');

        DesignType::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected design types deleted successfully"]);
    }
    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_design_types');

        DesignType::withTrashed()->whereIn('id', $request->selected_items_ids)->restore();

        return response(["selected design types restored successfully"]);
    }

}

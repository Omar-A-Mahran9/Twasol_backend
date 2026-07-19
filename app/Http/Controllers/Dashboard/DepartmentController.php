<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreDepartmentRequest;
use App\Http\Requests\Dashboard\UpdateDepartmentRequest;
use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_departments');

        if ($request->ajax()) {
            $data = getModelData(model: new Department());
            return response()->json($data);
        }

        return view('dashboard.departments.index');
    }

    public function store(StoreDepartmentRequest $request)
    {
        $data = $request->validated();

        Department::create($data);

        return response(["department created successfully"]);
    }

    public function update(UpdateDepartmentRequest $request, Department $department)
    {
        $data = $request->validated();

        $department->update($data);

        return response(["department updated successfully"]);
    }

    public function destroy(Department $department)
    {
        $this->authorize('delete_departments');

        $department->delete();

        return response(["department deleted successfully"]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_departments');

        Department::whereIn('id', $request->selected_items_ids)->delete();

        return response(["selected departments deleted successfully"]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_departments');

        Department::withTrashed()
            ->whereIn('id', $request->selected_items_ids)
            ->restore();

        return response(["selected departments restored successfully"]);
    }
}

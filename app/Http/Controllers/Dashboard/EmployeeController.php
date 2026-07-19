<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\StoreEmployeeRequest;
use App\Http\Requests\Dashboard\UpdateEmployeeRequest;
use App\Models\Department;
use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $this->authorize('view_employees');

        if ($request->ajax()) {
            $data = getModelData(
                model: new Employee(),
                relations: ['department' => ['id', 'name']]
            );

            return response()->json($data);
        }

        $departments = Department::query()
            ->orderBy('name')
            ->get();

        return view('dashboard.employees.index', compact('departments'));
    }

    public function store(StoreEmployeeRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('photo')) {
            $data['photo'] = uploadImageToDirectory(
                $request->file('photo'),
                'Employees'
            );
        }

        if ($request->hasFile('personal_file')) {
            $data['personal_file'] = uploadFileToDirectory(
                $request->file('personal_file'),
                'Employees/Personal'
            );
        }

        if ($request->hasFile('contract_file')) {
            $data['contract_file'] = uploadFileToDirectory(
                $request->file('contract_file'),
                'Employees/Contracts'
            );
        }

        Employee::create($data);

        return response([
            'message' => __('Employee created successfully')
        ]);
    }

    public function update(
        UpdateEmployeeRequest $request,
        Employee $employee
    ) {
        $data = $request->validated();

        $employee->update($data);

        return response([
            'message' => __('Employee updated successfully')
        ]);
    }

    public function destroy(Employee $employee)
    {
        $this->authorize('delete_employees');

        $employee->delete();

        return response([
            'message' => __('Employee deleted successfully')
        ]);
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete_employees');

        Employee::whereIn(
            'id',
            $request->selected_items_ids
        )->delete();

        return response([
            'message' => __('Selected employees deleted successfully')
        ]);
    }

    public function restoreSelected(Request $request)
    {
        $this->authorize('delete_employees');

        Employee::withTrashed()
            ->whereIn(
                'id',
                $request->selected_items_ids
            )
            ->restore();

        return response([
            'message' => __('Selected employees restored successfully')
        ]);
    }

    public function validateStep(Request $request)
    {
        $step = $request->step;

        $rules = match ($step) {

            'personal' => [
                'name' => ['required', 'string', 'max:255'],
                'phone' => ['required', 'string', 'max:20', 'unique:employees,phone'],
                'email' => ['nullable', 'email', 'unique:employees,email'],
                'national_id' => ['required', 'string', 'unique:employees,national_id'],
                'birth_date' => ['required', 'date'],
                'gender' => ['required', 'in:male,female'],
                'marital_status' => [
                    'required',
                    'in:single,married,divorced,widowed'
                ],
                'address' => ['required', 'string'],
            ],

            'job' => [
                'department_id' => [
                    'nullable',
                    'exists:departments,id'
                ],
                'job_title' => ['required', 'string', 'max:255'],
                'hire_date' => ['required', 'date'],
                'contract_type' => [
                    'required',
                    'in:full_time,part_time,contractor'
                ],
                'employment_status' => [
                    'required',
                    'in:active,suspended,terminated'
                ],
                'termination_date' => [
                    'nullable',
                    'date',
                    'required_if:employment_status,terminated'
                ],
            ],

            'files' => [
                'photo' => [
                    'nullable',
                    'image',
                    'mimes:jpg,jpeg,png,webp',
                    'max:2048'
                ],
                'personal_file' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120'
                ],
                'contract_file' => [
                    'nullable',
                    'file',
                    'mimes:pdf,jpg,jpeg,png',
                    'max:5120'
                ],
            ],

            default => [],
        };

        $validated = $request->validate($rules);

        return response()->json([
            'success' => true,
            'message' => __('Step validated successfully'),
        ]);
    }
}

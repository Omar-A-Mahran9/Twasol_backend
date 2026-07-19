<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return abilities()->contains('update_employees');
    }

    public function rules(): array
    {
        $employee = $this->route('employee');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'nullable',
                'email',
                'max:255',
                Rule::unique('employees', 'email')
                    ->ignore($employee->id),
            ],

            'phone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('employees', 'phone')
                    ->ignore($employee->id),
            ],

            'national_id' => [
                'nullable',
                'string',
                'max:20',
                Rule::unique('employees', 'national_id')
                    ->ignore($employee->id),
            ],

            'birth_date' => [
                'nullable',
                'date',
                'before:today',
            ],

            'gender' => [
                'nullable',
                Rule::in([
                    'male',
                    'female',
                ]),
            ],

            'marital_status' => [
                'nullable',
                Rule::in([
                    'single',
                    'married',
                    'divorced',
                    'widowed',
                ]),
            ],

            'address' => [
                'nullable',
                'string',
                'max:1000',
            ],

            'department_id' => [
                'nullable',
                'exists:departments,id',
            ],

            'job_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'hire_date' => [
                'nullable',
                'date',
            ],

            'termination_date' => [
                'nullable',
                'date',
                'after_or_equal:hire_date',
            ],

            'employment_status' => [
                'required',
                Rule::in([
                    'active',
                    'suspended',
                    'terminated',
                ]),
            ],

            'contract_type' => [
                'required',
                Rule::in([
                    'full_time',
                    'part_time',
                    'contractor',
                ]),
            ],

            'photo' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png,webp',
                'max:2048',
            ],

            'personal_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],

            'contract_file' => [
                'nullable',
                'file',
                'mimes:pdf,doc,docx,jpg,jpeg,png',
                'max:10240',
            ],
        ];
    }
}

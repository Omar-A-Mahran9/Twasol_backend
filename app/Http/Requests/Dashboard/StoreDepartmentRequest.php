<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize()
    {
        return abilities()->contains('create_departments');
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'unique:departments,name',
            ],

            'code' => [
                'required',
                'string',
                'max:255',
                'unique:departments,code',
            ],

            'description' => [
                'nullable',
                'string',
            ],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => __('The name field is required'),
            'name.unique' => __('The name has already been taken'),

            'code.required' => __('The code field is required'),
            'code.unique' => __('The code has already been taken'),
        ];
    }
}

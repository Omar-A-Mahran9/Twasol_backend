<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_cities');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
             "name_ar" => ["required", "string:255", 'regex:/^[ء-ي]+/', 'unique:cities'],
            "name_en" => ["required", "string:255", 'regex:/^[a-zA-Z]+(?:[\s-][a-zA-Z]+)*$/', 'unique:cities'],
        ];
    }
}

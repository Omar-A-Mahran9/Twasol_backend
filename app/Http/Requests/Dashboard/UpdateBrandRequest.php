<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBrandRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_brands');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $brand = request()->route('brand');

        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "name_ar" => ["required", "string:255", "unique:brands,name_ar,$brand->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:brands,name_en,$brand->id", new NotNumbersOnly()],
            "description_ar" => ["required", "string:255", new NotNumbersOnly()],
            "description_en" => ["required", "string:255", new NotNumbersOnly()],
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_packages');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $package = request()->route('package');
          return [
            "name_ar" => ["required", "string:255", "unique:brands,name_ar,$package->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:brands,name_en,$package->id", new NotNumbersOnly()],
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "from" => ["required"],
            "to" => ["required"],
            "car_id" => ["required"],
            "price" => ["required"],
            "from_time" => ["required"],
            "to_time" => ["required"],
             "package_categories_id" => ["required"],
             'cities' => 'required|array',       // Ensure cities is an array
             'cities.*' => 'exists:cities,id',  // Validate each city ID exists in cities table
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdatesubPackageCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_packagesubCategories');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $packageCategories = request()->route('packagesub_categories');
         return [
            "name_ar" => ["required", "string:255", "unique:packagesub_categories,name_ar,$packageCategories->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:packagesub_categories,name_en,$packageCategories->id", new NotNumbersOnly()],
            "package_categories_id" => ["required"],

       
        ];
    }
}

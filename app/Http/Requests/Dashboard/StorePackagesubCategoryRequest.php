<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StorePackagesubCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_packagesubCategories');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "name_ar" => ["required", "string:255", new NotNumbersOnly()],
            "name_en" => ["required", "string:255",new NotNumbersOnly()],
            "package_categories_id" => ["required"],
        ];
    }
}

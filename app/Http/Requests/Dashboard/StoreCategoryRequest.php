<?php

namespace App\Http\Requests\Dashboard;

use App\Models\SubCategory;
use App\Rules\NotNumbersOnly;
use App\Rules\ExistButDeleted;
use App\Rules\UniqueCategoryName;
use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_categories');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
         return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "name_ar" => ["required", "string:255", new NotNumbersOnly(), "unique:sub_categories,name_ar", new ExistButDeleted(new SubCategory())],
            "name_en" => ["required", "string:255", new NotNumbersOnly(), "unique:sub_categories,name_ar", new ExistButDeleted(new SubCategory())],
            "description_ar" => ["required", "string:255", new NotNumbersOnly()],
            "description_en" => ["required", "string:255", new NotNumbersOnly()],
            'meta_tag_key_words' => ["nullable", "string:255", new NotNumbersOnly()],
            'meta_tag_key_description' => ["nullable", "string:255", new NotNumbersOnly()],
            'parent_id' => ["required_if:category_type,sub", 'array'],
            'parent_id.*' => ["required_if:category_type,sub"],
        ];
    }
    public function messages()
    {
        return [
            'parent_id.required_if' => __('The parent ID is required when the category type is sub-category'),
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_categories');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = request()->route('category');
        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "name_ar" => ["required", "string:255", new NotNumbersOnly(), Rule::unique('sub_categories')->ignore($category)],
            "name_en" => ["required", "string:255", new NotNumbersOnly(), Rule::unique('sub_categories')->ignore($category)],
            'description_ar' => ["required", "string:255", new NotNumbersOnly()],
            'description_en' => ["required", "string:255", new NotNumbersOnly()],
            'meta_tag_key_words' => ["nullable", "string:255", new NotNumbersOnly()],
            'meta_tag_key_description' => ["nullable", "string:255", new NotNumbersOnly()],
            'parent_id' => ["required_if:category_type,sub", 'array'],
            'parent_id.*' => ["required_if:category_type,sub"],
        ];
    }
}

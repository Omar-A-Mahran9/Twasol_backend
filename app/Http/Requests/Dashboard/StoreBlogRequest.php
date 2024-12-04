<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_blogs');
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
            "name_ar" => ["required", "max:255", new NotNumbersOnly(), "unique:blogs,name_ar"],
            "name_en" => ["required", "max:255", new NotNumbersOnly(), "unique:blogs,name_en"],
            "description_ar" => ["required", new NotNumbersOnly()],
            "description_en" => ["required", new NotNumbersOnly()],
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreWhyusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_whyus');
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
            "title_ar" => ["required", "max:255", new NotNumbersOnly(), "unique:whyuses,title_ar"],
            "title_en" => ["required", "max:255", new NotNumbersOnly(), "unique:whyuses,title_en"],
            "description_ar" => ["required", new NotNumbersOnly()],
            "description_en" => ["required", new NotNumbersOnly()],
        ];
    }
}

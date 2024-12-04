<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_sliders');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'background' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            "title_ar" => ["required", "string:255", new NotNumbersOnly()],
            "title_en" => ["required", "string:255", new NotNumbersOnly()],
            "description_ar" => ["required", "string:255", new NotNumbersOnly()],
            "description_en" => ["required", "string:255", new NotNumbersOnly()],
            'btn_title_ar' => ["required", "string:255", new NotNumbersOnly()],
            'btn_title_en' => ["required", "string:255", new NotNumbersOnly()],
            'btn_link' => ["required", "url", "string:255", new NotNumbersOnly()],
            'status' => ["nullable", "in:0,1"],
        ];
    }
}

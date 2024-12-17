<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateGallaryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_gallary');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $gallaries = request()->route('gallary');
         return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:1000',
            "name_ar" => ["required", "string:255", "unique:gallaries,name_ar,$gallaries->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:gallaries,name_en,$gallaries->id", new NotNumbersOnly()],
        ];
    }
}

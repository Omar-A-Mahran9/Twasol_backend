<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSkinColorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_colors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $skinColor = request()->route('skin_color');

        return [
            "name_ar" => ["required", "string:255", "unique:skin_colors,name_ar,$skinColor->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:skin_colors,name_en,$skinColor->id", new NotNumbersOnly()],
        ];
    }
}

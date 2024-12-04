<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateDesignTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_design_types');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $designType = request()->route('design_type');

        return [
            "name_ar" => ["required", "string:255", "unique:design_types,name_ar,$designType->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "unique:design_types,name_en,$designType->id", new NotNumbersOnly()],
        ];
    }
}

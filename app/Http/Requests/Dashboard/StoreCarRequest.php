<?php

namespace App\Http\Requests\Dashboard;

use App\Models\SubCategory;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_cars');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentStep    = request()->route('step');

        $stepsRules = [
            [
                "name_ar" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "name_en" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "description_ar" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "description_en" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'category_id' => ['required'],
                'brand_id' => 'required|min:1',
                'price' => 'required|min:1',
                'bags_counts' => 'required|min:1',
                'passengers_counts' => 'required|min:1',
               ],
            [
                'images' => 'required|array|min:1|max:10',
                'images.*' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
            ],
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

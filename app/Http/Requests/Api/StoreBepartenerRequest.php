<?php

namespace App\Http\Requests\Api;

use App\Models\SubCategory;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreBepartenerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
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
               "name" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                'city_ids' => 'required|array|min:1',
                'brand_id' => 'required|min:1',
                'color_id' => 'required|min:1',
                'year' => 'required|min:1|integer',
                'car_number' => 'required|min:1|integer',
            ],
            [
                'Id_image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
                'Personal_image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
                'License_image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
                'car_paper_image' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
            ],
            [
                "bank_owner_name" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                'iban_number' => 'required|min:1|integer|unique:payment_data,iban_number',
                "address" => ['required', 'string', 'max:50'],
                "BIC_Swift" => ['required', 'string', 'max:50', 'unique:payment_data,BIC/Swift'],
             ],
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

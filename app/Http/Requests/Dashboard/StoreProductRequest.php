<?php

namespace App\Http\Requests\Dashboard;

use App\Models\SubCategory;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_products');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $currentStep    = request()->route('step');
        $sizes          = array_filter(array_column(request()->input('variations', []), 'size'), function ($value) {
            return !is_null($value);
        });
        $sizeRequired   = '';
        $weightRequired = '';
        if (SubCategory::find(request()->input('subcategories'))[0]->size_applicable) {
            $sizeRequired = 'required';
        } else {
            $sizeRequired = 'nullable';
        }
        if (in_array(1, request()->input('categories', [])) || in_array(2, request()->input('categories', [])) || in_array(3, request()->input('categories', [])) || in_array(5, request()->input('categories', []))) {
            $weightRequired = 'required';
        } else {
            $weightRequired = 'nullable';
        }
        $stepsRules = [
            [
                "name_ar" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "name_en" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "description_ar" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "description_en" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'vendor_id' => 'required|exists:vendors,id',
                'categories' => ['required', 'array', 'min:1'],
                'subcategories' => ['nullable', 'array', 'min:1'],
                'tags' => ['required', 'array', 'min:1'],
                'brand_id' => 'nullable|min:1',
                'design_type_id' => 'nullable|exists:design_types,id',
                'caliber' => ['nullable'],
                'video_link' => 'nullable|url',
                "maintenance_and_care" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                "packaging" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                "sustainable_assets" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                "main_stone" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                "guarantee" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                "color" => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                'cities' => ['required', 'array', 'min:1'],
                'type' => 'required|in:Used,New',
                // 'status' => 'required|in:In Stock,Out Stock',
                'rejection_reason' => ['required_if:status,Rejected', new NotNumbersOnly()],
                'meta_tag_key_words' => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
                'meta_tag_key_description' => ['nullable', 'string', 'max:255', new NotNumbersOnly()],
            ],
            [
                'price_change' => ['nullable', 'boolean'],
                'variations' => ['required', 'array', 'min:1'],
                'variations.*.size' => [
                    $sizeRequired,
                    'numeric',
                    'min:1',
                    function ($attribute, $value, $fail) use ($sizes) {
                        if (is_null($value)) {
                            return; // Skip if value is null
                        }
                        $count = array_count_values($sizes);
                        if ($count[$value] > 1) {
                            $fail('The size must be unique.');
                        }
                    },

                ],
                'variations.*.weight' => [
                    $weightRequired,
                    'numeric',
                    'gt:0',
                    function ($category) {
                        if (request()->input('categories') == 1 && request()->input('categories') == 2) {
                            return 'required';
                        }
                    }
                ],
                "variations.*.price" => 'required|numeric|min:1',
                'variations.*.discount_price' => 'nullable|required_with:variations.*.discount_from|numeric|lt:variations.*.price',
                'variations.*.discount_from' => 'nullable|required_with:variations.*.discount_price|date|after:today|before:variations.*.discount_to',
                'variations.*.discount_to' => 'nullable|required_with:variations.*.discount_price|date|after:today|after:variations.*.discount_from',
                'variations.*.stock' => [
                    'required',
                    'numeric',
                    'min:1',
                ],
            ],
            [
                'images' => 'required|array|min:1|max:10',
                'images.*' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
            ],
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

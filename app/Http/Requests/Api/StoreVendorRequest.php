<?php

namespace App\Http\Requests\Api;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'commercial_register_number' => 'required|numeric|digits:10|unique:vendors',
            'national_id' => 'required|numeric|digits:10|unique:vendors',
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:vendors'],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', 'unique:vendors'],
            // 'iban_number'=>['required', 'string'],
            'brand_name_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            // 'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'confirmed'],
            // 'password_confirmation' => ['required', 'same:password'],
            'privacy_flag' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 0 || $value == false || $value == "false")
                    {
                        $fail(__('Must be approved first'));

                    }
                }
            ],
        ];
    }
}

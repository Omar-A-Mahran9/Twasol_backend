<?php

namespace App\Http\Requests\Api;

use App\Models\Customer;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Enums\PayingOffStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderCheckoutRequest extends FormRequest
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
        $currentStep = request()->route('step');

        $stepsRules = [
            [
                "type" => 'required|string|in:Personal,Gift',
                "first_name" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "last_name" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "phone" => [
                    'required',
                    'string',
                    'max:255',
                    new PhoneNumber(),
                    function ($attribute, $value, $fail) {
                        $customer = Customer::where('email', request()->input('email'))->orWhere('phone', $value)->first();
                        if ($customer)
                            if ($customer->phone == $value) {
                                if (!($customer->email == request()->input('email'))) {
                                    $fail(__('There is an account with the same phone number'));
                                }
                            }
                    }
                ],
                "email" => [
                    'required',
                    'email:rfc,dns',
                    function ($attribute, $value, $fail) {
                        $customer = Customer::where('email', $value)->orWhere('phone', request()->input('phone'))->first();
                        if ($customer)
                            if ($customer->email == $value) {
                                if (!($customer->phone == request()->input('phone'))) {
                                    $fail(__('There is an account with the same email'));
                                }
                            }
                    }
                ],
                "gift_owner_name" => ['nullable', 'string', 'max:255', 'required_if:type,Gift'],
                "gift_owner_phone" => ['nullable', 'string', 'max:255', 'required_if:type,Gift'],
                "gift_text" => ['nullable', 'string', 'max:255', 'required_if:type,Gift'],
            ],
            [
                'city' => ['required', 'integer', 'exists:cities,id'],
                'street_name' => ['required', 'string', new NotNumbersOnly()],
                'building_number' => 'required',
                'district' => ['required', 'string', new NotNumbersOnly()],
                'lat' => ['nullable', 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
                'lng' => ['nullable', 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/'],
                'marks' => 'nullable|string',
            ],
            [
                'products' => 'required',
                'products.*' => 'required',
                'products.*.*' => 'required',
                'paying_off' => ['required', Rule::in([PayingOffStatus::Paid->value, PayingOffStatus::cashOnDelivery->value])],
                'total' => 'required'
            ]
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

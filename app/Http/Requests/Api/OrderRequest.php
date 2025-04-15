<?php

namespace App\Http\Requests\Api;

use App\Models\Customer;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Enums\PayingOffStatus;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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

        // Define validation rules for each step
        $stepsRules = [
            0 => [
                "addon_service_id" => ['required'],

            ],
          

            3 => [  // Step 3 (combine the fields from steps 1 and 2)
                "email" => ['nullable', 'email'],
                "name" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "phone" => [
                    'required',
                    'string',
                    'max:255',
                    new PhoneNumber(),
                    function ($attribute, $value, $fail) {
                        $customer = Customer::where('email', request()->input('email'))->orWhere('phone', $value)->first();
                        if ($customer && $customer->phone == $value && $customer->email != request()->input('email')) {
                            $fail(__('There is an account with the same phone number'));
                        }
                    }
                ],
                'city_id'=>['required'],
                "address" => ['required', 'string'],
                'date' => ['required','date'],
                'addon_service_id' => ['required', 'numeric'],
                'description'=>['required'],
            ]
        ];

        // Return validation rules for the current step
        return $stepsRules[$currentStep] ?? [];
    }
}

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

        $stepsRules = [
         
            [
                "email" => ['required', 'email'],

                "name" => ['required', 'string', 'max:255', new NotNumbersOnly()],
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
                'city_id'=>['required'],
                "address" => ['required', 'string'],

            ],
            [
                'date' => ['required','date'],
                'addon_service_id'=>['required'],
                'description'=>['required'],

            ],
            [
                "email" => ['required', 'email'],

                "name" => ['required', 'string', 'max:255', new NotNumbersOnly()],
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
                'city_id'=>['required'],
                "address" => ['required', 'string'],

                'date' => ['required','date'],
                'addon_service_id'=>['required'],
                'description'=>['required'],

            ],
          
            
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

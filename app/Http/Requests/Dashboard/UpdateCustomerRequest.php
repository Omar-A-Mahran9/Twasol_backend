<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
{
    public function authorize()
    {
        return abilities()->contains('update_customers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $customer = $this->route('customer');

        return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', Rule::unique('customers')->ignore($customer->id)],
            'email' => ['required', 'string', 'email', Rule::unique('customers')->ignore($customer->id)],
            'password' => ['nullable', 'exclude_if:password,null', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['nullable', 'exclude_if:password_confirmation,null', 'same:password'],
        ];
    }
}

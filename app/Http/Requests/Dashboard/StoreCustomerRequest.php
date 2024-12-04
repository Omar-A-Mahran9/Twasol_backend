<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Customer;
use App\Rules\ExistButDeleted;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreCustomerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_customers');
    }

    public function rules()
    {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', 'unique:customers'],
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:customers'],
            'password'=> ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/'],
            'password_confirmation' => ['required','same:password'],
        ];
    }
}

<?php

namespace App\Http\Requests\Vendor;

use App\Rules\Vendor\CurrentVendorPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfilePasswordRequest extends FormRequest
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
            'current_password'=> ['required', new CurrentVendorPassword, Rule::excludeIf(!is_null($this->current_password))],
            'password' => ['required_with:current_password', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'max:50', 'confirmed'],
            'password_confirmation' => ['required_with:password','same:password', Rule::excludeIf(!is_null($this->password_confirmation))],
        ];
    }
}

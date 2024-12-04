<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\Vendor\CurrentVendorPassword;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileEmailRequest extends FormRequest
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
        $vendor = auth()->user();
        return [
            'email' => ['required', 'string', 'email:rfc,dns', Rule::unique('vendors')->ignore($vendor->id)],
            'confirm_email_password' => ['required', new CurrentVendorPassword],
        ];
    }
}

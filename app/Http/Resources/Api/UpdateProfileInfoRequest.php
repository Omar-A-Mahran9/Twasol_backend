<?php

namespace App\Http\Requests\Api;

use App\Models\Admin;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileInfoRequest extends FormRequest
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
        $admin = auth()->user();
        return [
            'full_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => ['required', 'string', new PhoneNumber(), new ExistPhone(new Admin(), $admin->id), 'max:20', Rule::unique('admins')->ignore($admin->id)],
            'email' => 'required|string|email|unique:customers',
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',

        ];
    }
}

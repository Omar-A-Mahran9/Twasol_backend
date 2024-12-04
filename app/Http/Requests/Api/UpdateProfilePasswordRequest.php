<?php

namespace App\Http\Requests\Api;

use App\Rules\MatchOldPassword;
use App\Rules\ValidateOldPassword;
use Illuminate\Foundation\Http\FormRequest;

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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'old_password' => ['required', 'string', 'min:8', 'max:255', new ValidateOldPassword],
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'max:255', new MatchOldPassword, 'confirmed'],
            'password_confirmation' => 'required|same:password',
        ];
    }
}

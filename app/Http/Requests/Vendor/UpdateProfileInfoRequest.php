<?php

namespace App\Http\Requests\Vendor;

use App\Models\Vendor;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

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
        $id = auth()->user()->id;

        return [
            'logo' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'cover' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'commercial_register' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'licensure' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            "description_ar" => ["required", "string:137", new NotNumbersOnly()],
            "description_en" => ["required", "string:137", new NotNumbersOnly()],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', new PhoneNumber(), new ExistPhone(new Vendor(), $id), Rule::unique('vendors')->ignore($id)],
            'address' => 'required|string|max:255',
            'commercial_register_number' => ['required', 'string', 'max:10', Rule::unique('vendors')->ignore($id)],
            'national_id' => ['required', 'string', 'max:10', Rule::unique('vendors')->ignore($id)],
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Vendor;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateVendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('update_vendors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $vendor = $this->route('vendor');

        return [
            'logo' => ['required_unless:logo,null', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
            'cover' => ['required_unless:cover,null', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
            'commercial_register' => ['required_unless:commercial_register,null', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
            'licensure' => ['required_unless:licensure,null', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'],
            'name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'brand_name_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'brand_name_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            "description_ar" => ["required", "string:137", new NotNumbersOnly()],
            "description_en" => ["required", "string:137", new NotNumbersOnly()],
            'phone' => ['required', 'string', 'max:20', Rule::unique('vendors')->ignore($vendor->id), new PhoneNumber(), new ExistPhone(new Vendor(), $vendor->id)],
            'email' => ['required', 'string', 'email', Rule::unique('vendors')->ignore($vendor->id)],
            'subscription_id' => ['nullable', 'min:1'],
            'subscription_end_date' => ['nullable', 'required_with:subscription_id', 'date'],
            'address' => 'required|string|max:255',
            'commercial_register_number' => ['required', 'string', 'min:10', 'max:10', Rule::unique('vendors')->ignore($vendor->id)],
            'national_id' => ['required', 'string', 'min:10', 'max:10', Rule::unique('vendors')->ignore($vendor->id)],
            // 'password' => ['nullable', 'exclude_if:password,null', 'string', 'min:8', 'max:50', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'confirmed'],
            // 'password_confirmation' => ['nullable', 'exclude_if:password_confirmation,null', 'same:password'],
            'ratio.*' => ['required'],
            'iban_number' => ['required']

        ];
    }
}

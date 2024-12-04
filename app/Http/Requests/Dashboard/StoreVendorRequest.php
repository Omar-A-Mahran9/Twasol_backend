<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Vendor;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Rules\ExistButDeletedDashboard;
use Illuminate\Foundation\Http\FormRequest;

class StoreVendorRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_vendors');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'logo' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'cover' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'commercial_register' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'licensure' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            'name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'brand_name_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'brand_name_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            "description_ar" => ["required", "string:137", new NotNumbersOnly()],
            "description_en" => ["required", "string:137", new NotNumbersOnly()],
            'phone' => ['required', 'string', 'max:20', new ExistButDeletedDashboard(new Vendor()), new PhoneNumber(), new ExistPhone(new Vendor())],
            'address' => 'required|string|max:255',
            'email' => ['required', 'string', 'email:rfc,dns', 'unique:vendors', new ExistButDeletedDashboard(new Vendor())],
            'commercial_register_number' => 'required|string|min:10|max:10|unique:vendors',
            'national_id' => 'required|string|min:10|max:10|unique:vendors',
            'subscription_id' => ['nullable', 'min:1'],
            'subscription_end_date' => ['nullable', 'required_with:subscription_id', 'date'],
            'ratio.*' => ['required'],
            'iban_number' => ['required']
        ];
    }
}

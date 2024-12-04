<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreVendorShipmentDataRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            // 'code' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'regex:/(^(009665|9665|\+9665|05|5)(5|0|3|6|4|9|1|8|7)([0-9]{7})$)/u', 'max:255'],
            'city_id' => ['required','exists:cities,id'],
            'country_code' => ['required', 'string', 'min:2', 'max:2'],
            'street_address' => ['required', 'string', 'max:255'],
            'contact_name' => ['required', 'string', 'max:255'],
            'contact_email' => ['required', 'email:rfc,dns', 'max:255'],
            'lat' => ['required'],
            'lng' => ['required']
        ];
    }
}

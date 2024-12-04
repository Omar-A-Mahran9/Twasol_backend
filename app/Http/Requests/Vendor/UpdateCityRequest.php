<?php

namespace App\Http\Requests\Vendor;

use App\Models\CityVendor;
use App\Rules\ExistButDeleted;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCityRequest extends FormRequest
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
        $city = request()->route('branch');
        return [
            'city_id'=> ['required', 'integer', 'exists:cities,id',new ExistButDeleted(new CityVendor() ), Rule::unique('city_vendor')->where(function ($query) {
                return $query->where('vendor_id', auth()->user()->id);
            })->ignore($city)],
        ];
    }
}
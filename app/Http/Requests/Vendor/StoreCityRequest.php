<?php

namespace App\Http\Requests\Vendor;

use App\Models\CityVendor;
use App\Rules\ExistButDeleted;
use Illuminate\Validation\Rule;
use App\Rules\Vendor\CityUniqueness;
use App\Rules\Vendor\IsFastShippingCity;
use Illuminate\Foundation\Http\FormRequest;

class StoreCityRequest extends FormRequest
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
            'city_id' => ['required', 'integer', 'exists:cities,id', new CityUniqueness,new ExistButDeleted(new CityVendor() )],
        ];
    }
}
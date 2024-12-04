<?php

namespace App\Http\Requests\Dashboard;

use App\Models\FastCity;
use App\Rules\ExistButDeleted;
use Illuminate\Foundation\Http\FormRequest;

class StoreFastShippingCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_fast_cities');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id', 'unique:fast_cities,city_id',new ExistButDeleted( new FastCity())],
            'shipping_price' => 'required|nullable|numeric',
        ];
    }
}
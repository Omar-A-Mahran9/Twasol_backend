<?php

namespace App\Http\Requests\Dashboard;

use App\Models\CityVendor;
use App\Rules\ExistButDeleted;
use Illuminate\Foundation\Http\FormRequest;

class UpdateFastShippingCityRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_fast_cities');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $fastShipping = request()->route('fast_shipping_city');
        // dd($fastShipping);
        return [
            'city_id' => ['required', 'integer', 'exists:cities,id', "unique:fast_cities,city_id,$fastShipping",new ExistButDeleted(new CityVendor() )],
            'shipping_price' => 'required|nullable|numeric',
        ];
    }
}
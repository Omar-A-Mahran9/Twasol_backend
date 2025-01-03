<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCarPriceRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_carPrices');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $category = request()->route('carPrices');
        return [
            "type" => ["required"],
            "from" => ["required_if:type,per_trip"],
            "to" => ["required_if:type,per_trip"],
            "city" => ["required_if:type,per_hour"],
            "car_id" => ["required"],
            "price" => ["required"],
            "statue" => ["required"],
        ];
    }
}

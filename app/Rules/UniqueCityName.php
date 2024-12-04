<?php

namespace App\Rules;

use App\Models\City;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCityName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(City::where('fast_shipping', request()->input('fast_shipping') ?? FALSE)->where(''.$attribute, $value)->exists())
        {
            $fail(__('' . $attribute) . __(' is already taken'));
        }
    }
}

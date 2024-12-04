<?php

namespace App\Rules\Vendor;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class CityUniqueness implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(DB::table("city_vendor")->where("city_id", $value)->where('vendor_id', auth()->user()->id)->exists())
        {
            $fail(__('City is already exists'));
        }
    }
}

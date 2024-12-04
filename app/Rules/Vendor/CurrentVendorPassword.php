<?php

namespace App\Rules\Vendor;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Hash;

class CurrentVendorPassword implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $vendor = auth()->user();
        $password = $value;

        if (!Hash::check($password, $vendor->password))
        {
            $fail(__('Password is incorrect'));
        }
    }
}

<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class NotNumbersOnly implements Rule
{
    public function passes($attribute, $value)
    {
        // Check if the name doesn't consist of numbers only
        return !preg_match('/^\d+$/', $value);
    }

    public function message()
    {
        return __(":attribute") . __(' must be valid');
    }
}

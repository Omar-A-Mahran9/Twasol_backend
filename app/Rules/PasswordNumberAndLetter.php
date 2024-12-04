<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PasswordNumberAndLetter implements Rule
{
    public function passes($attribute, $value)
    {
        return (preg_match('/^(?=.*[A-Za-z])(?=.*\d)[\w\d]*[@$!%*?&]?[\w\d]*$/', $value));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __(":attribute ") . __('It must consist of letters and numbers');
    }
}


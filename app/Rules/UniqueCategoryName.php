<?php

namespace App\Rules;

use App\Models\Category;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class UniqueCategoryName implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(request()->input('parent_id'))
        {
            if(Category::where('parent_id', request()->input('parent_id'))->where(''.$attribute, $value)->first())
            {
                $fail($attribute . __(' is already taken'));
            }
        }else{
            if(Category::where(''.$attribute, $value)->first())
            {
                $fail($attribute . __(' is already taken'));
            }
        }
    }
}

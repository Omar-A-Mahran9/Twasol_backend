<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Contracts\Validation\ValidationRule;

class ExistPhone implements ValidationRule
{
    private $model;
    private $adminId;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct(Model $model, $adminId = null)
    {
        $this->model   = $model;
        $this->adminId = $adminId;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function validate($attribute, mixed $value, Closure $fail): void
    {
        $normalizedValue = Str::startsWith($value, '0') ? ltrim($value, '0') : '0' . $value;
        if ($this->adminId)
        {
            $existsNormalized = $this->model
                ->withTrashed()
                ->where('phone', 'LIKE', "%" . $normalizedValue . "%")
                ->where('id', '!=', $this->adminId)
                ->exists();
        } else
        {
            $existsNormalized = $this->model
                ->withTrashed()
                ->where('phone', 'LIKE', "%" . $normalizedValue . "%")->exists();
        }
        if ($existsNormalized)
        {
            $fail(__("The") . " " . __(":attribute") . ' ' . __('has already been taken'));
        }
    }
}

<?php

namespace App\Rules;

use App\Models\Cars;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidateMaxImages implements ValidationRule
{
    private $car;
    private $deletedImages = [];

    public function __construct(Cars $car, $deletedImages = null)
    {
        $this->car = $car;
        $this->deletedImages = $deletedImages;
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Count the images when storing
        $conditionOfStore = count(request()->images) + $this->car->images()->count();
        
        // If there are deleted images, adjust the count accordingly for an update scenario
        if ($this->deletedImages != 0) {
            $conditionOfUpdate = $this->car->images()->count() - count($this->deletedImages) + count(request()->images);
        }

        // Check condition for update or store
        if (isset($conditionOfUpdate)) {
            if ($conditionOfUpdate > 5) {
                $fail(__('Images exceeds the maximum number'));
            }
        } else {
            if ($conditionOfStore > 5) {
                $fail(__('Images exceeds the maximum number'));
            }
        }
    }
}

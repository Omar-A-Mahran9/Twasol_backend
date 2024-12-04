<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Cars;
use DateTime;
use App\Models\SubCategory;
use App\Rules\NotNumbersOnly;
use App\Rules\ValidateMaxImages;
use App\Models\CarsSpecification;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('update_cars');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(Cars $car): array
    {

        $currentStep    = request()->route('step');
        // $deleted_images = json_decode(request()->deleted_images);

        // // $car        = request()->route('car');
   
        // // $car->loadCount('images');
        // $oldImagesDeleted = $car->images_count == count($deleted_images);
        //  $imagesStatus     = $oldImagesDeleted && !request()->images ? 'required' : 'nullable';
        $stepsRules = [
            [
                "name_ar" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "name_en" => ['required', 'string', 'max:50', new NotNumbersOnly()],
                "description_ar" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                "description_en" => ['required', 'string', 'max:255', new NotNumbersOnly()],
                'category_id' => ['required'],
                'brand_id' => 'required|min:1',
                'price' => 'required|min:1',
                'bags_counts' => 'required|min:1',
                'passengers_counts' => 'required|min:1',
            ],
            [
                // 'images' => [$imagesStatus, 'array', 'min:1', 'max:10', new ValidateMaxImages($car->images, $deleted_images)],
                'images.*' => 'required|mimes:jpeg,jpg,png,gif,svg|max:512',
            ],
        ];

        return array_key_exists($currentStep, $stepsRules) ? $stepsRules[$currentStep] : [];
    }
}

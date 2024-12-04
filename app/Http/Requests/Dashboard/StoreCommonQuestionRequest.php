<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreCommonQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('create_CommonQuestion');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "question_ar" => ["required", "string", "max:255", new NotNumbersOnly()],
            "question_en" => ["required", "string", "max:255", new NotNumbersOnly()],
            "answer_ar" => ["required", "string", new NotNumbersOnly()],
            "answer_en" => ["required", "string", new NotNumbersOnly()],
        ];
        
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommonQuestionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_CommonQuestion');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $CommonQuestion = request()->route('CommonQuestion');
        return [
            "question_ar" => [
                "required", 
                "string", 
                "max:255", 
                "unique:common_questions,question_ar,{$CommonQuestion->id}", // Ensure uniqueness except for the current record
                new NotNumbersOnly()
            ],
            "question_en" => [
                "required", 
                "string", 
                "max:255", 
                "unique:common_questions,question_en,{$CommonQuestion->id}", // Ensure uniqueness except for the current record
                new NotNumbersOnly()
            ],
            "answer_ar" => [
                "required", 
                "string", 
               
                new NotNumbersOnly()
            ],
            "answer_en" => [
                "required", 
                "string", 
               
                new NotNumbersOnly()
            ],
        ];
    }
}

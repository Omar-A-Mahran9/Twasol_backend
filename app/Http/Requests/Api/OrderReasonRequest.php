<?php

namespace App\Http\Requests\Api;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class OrderReasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'order_reason_id' => ['required', 'exists:order_reasons,id'],
            'order_id' => ['required', 'exists:orders,id'],
            'comment' => ['nullable', new NotNumbersOnly()],
        ];
    }
}

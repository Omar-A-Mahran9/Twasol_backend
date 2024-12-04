<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class StoreAdRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_ads');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'vendor_id' => 'required|min:1',
            'title_ar' => ['required', 'min:3', 'string', new NotNumbersOnly()],
            'title_en' => ['required', 'min:3', 'string', new NotNumbersOnly()],
            'description_ar' => ['required', 'min:3', 'string', new NotNumbersOnly()],
            'description_en' => ['required', 'min:3', 'string', new NotNumbersOnly()],
            'status' => 'required|in:Active,Expired',
            'link' => 'required|url',
        ];
    }
}

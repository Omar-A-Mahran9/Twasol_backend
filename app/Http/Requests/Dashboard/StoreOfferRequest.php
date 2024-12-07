<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class StoreOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('create_offers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "name_ar" => 'required|string|max:255|unique:offers',
            "name_en" => 'required|string|max:255|unique:offers',
            "description_ar" => 'required|string|max:255',
            "description_en" => 'required|string|max:255',
            "price" => 'required|numeric|min:1',
            'addon_service_id' => 'required|min:1',
            'status' => 'required|in:Pending,Rejected,Approved',
             'meta_tag_key_words' => 'nullable|string|max:255',
            'meta_tag_key_description' => 'nullable|string|max:255',
        ];
    }
}

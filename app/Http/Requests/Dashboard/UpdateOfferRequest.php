<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('update_offers');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $offer = request()->route('offer');

        return [
            "name_ar" => ["required", "string:255", "unique:offers,name_ar,$offer->id"],
            "name_en" => ["required", "string:255", "unique:offers,name_ar,$offer->id"],
            "description_ar" => 'required|string|max:255',
            "description_en" => 'required|string|max:255',
            "price" => 'required|numeric|min:1',
            'vendor_id' => 'required|min:1',
            'category_id' => 'required|min:1',
            'status' => 'required|in:Pending,Rejected,Approved',
            'rejection_reason' => 'required_if:status,Rejected',
            'meta_tag_key_words' => 'nullable|string|max:255',
            'meta_tag_key_description' => 'nullable|string|max:255',
        ];
    }
}

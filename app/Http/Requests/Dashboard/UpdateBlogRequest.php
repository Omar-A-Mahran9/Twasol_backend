<?php

namespace App\Http\Requests\Dashboard;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateBlogRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return abilities()->contains('update_blogs');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $blog = request()->route('blog');
         return [
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:512',
            "name_ar" => ["required", "string:255", "name_ar,$blog->id", new NotNumbersOnly()],
            "name_en" => ["required", "string:255", "name_en,$blog->id", new NotNumbersOnly()],
            "description_ar" => ["required", "string:255", new NotNumbersOnly()],
            "description_en" => ["required", "string:255", new NotNumbersOnly()],
        ];
    }
}

<?php

namespace App\Http\Requests\Dashboard;

use App\Models\Admin;
use App\Rules\ExistPhone;
use App\Rules\PhoneNumber;
use App\Rules\NotNumbersOnly;
use App\Rules\ExistButDeleted;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderReasonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return abilities()->contains('update_order_reasons');
    }

    public function rules()
    {
        return [
            'reason_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'reason_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'type' => ['required', 'in:Refund,Cancel'],
        ];
    }
}

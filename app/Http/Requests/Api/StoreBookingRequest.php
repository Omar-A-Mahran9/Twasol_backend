<?php

namespace App\Http\Requests\Api;

use App\Rules\PhoneNumber;
use Illuminate\Foundation\Http\FormRequest;

class StoreBookingRequest extends FormRequest
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
              // Correct field validation rules
              'type' => ['required', 'in:per_trip,per_hour,per_package,booking_start'],

              'name' => ['required', 'string', 'max:255'],
              'email' => ['required', 'email'],
              'phone' => ['required', 'string', 'min:10', 'max:15', new PhoneNumber()],

            //   'ticket_image' => ['required_if:type,per_trip', 'required_if:type,per_hour','nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],

              'ticket_image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
              'addon_services' => ['required_if:type,per_trip', 'required_if:type,per_hour', 'array'],
           
              'car_prices_id' => [
                'required_if:type,per_trip', 
                'required_if:type,per_hour',
                'exists:car_prices,id', // Ensure that car_prices_id exists in the car_prices table
            ],
            'note' => [
                'required_if:type,per_trip', 
                'required_if:type,per_hour',
            ],
            'payment_method_id' => [
                'required_if:type,per_trip,per_package', 
                'required_if:type,per_hour',
                'exists:payment_methods,id', // Ensure that payment_method_id exists in the payment_methods table
            ],
            'payment_way_id' => [
                'required_if:type,per_trip,per_package', 
                'required_if:type,per_hour',

                'exists:payment_ways,id', // Ensure that payment_way_id exists in the payment_ways table
            ],
              

              'card_number' => ['required', 'string', 'min:13', 'max:19'], // Ensure it is numeric and 13 to 19 digits long
              'security_code' => ['required', 'numeric', 'digits_between:3,4'], // CVV should be 3 or 4 digits
              'end_date_month' => ['required', 'integer', 'between:1,12'], // Month should be between 1 and 12
              'end_date_year' => ['required', 'integer', 'digits:4', 'min:' . date('Y')], // Year should be a 4-digit number and should not be in the past
              'first_name' => ['required', 'string', 'max:255'], // Ensure first name is a string and not too long
              'last_name' => ['required', 'string', 'max:255'], // Ensure last name is a string and not too long
       

            'go_only' => ['sometimes', 'boolean'],
            'go_and_return' => ['sometimes', 'boolean'],
           
        

            // 'from_time' => ['required'],
            // 'to_time' => ['required'],
            'time' => ['required_if:type,per_trip','required_if:type,per_hour'],
            'date' => ['required_if:type,per_trip','required_if:type,per_hour'],
            'time_hours' => ['required_if:type,per_hour'],

            'package_id' => ['required_if:type,per_package'],
            // 'email' => ['required', 'email'],
            // 'message' => ['required']
        ];
        
    }
}

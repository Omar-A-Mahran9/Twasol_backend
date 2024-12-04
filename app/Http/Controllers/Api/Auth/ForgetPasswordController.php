<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\Customer;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use App\Http\Resources\Api\CustomerResource;

class ForgetPasswordController extends Controller
{

    public function sendOtp(Request $request, $phone)
    {
        $customer = Customer::where('phone', $phone)->first();
        if (!$customer)
            return $this->failure(__("This user does not exist"));

        $request['phone'] = $customer->phone;

        $request->validate([
            'phone' => ['required', 'exists:customers'],
        ]);
        if ($customer->block_flag === 1)
        {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }
        $customer->sendOTP();
        
        return $this->success("Send otp is successfully", ["customer" => new CustomerResource($customer)]);
    }

    public function reSendOtp(Request $request, $phone)
    {
        $customer = Customer::where('phone', $phone)->first();
        if (!$customer)
            return $this->failure(__("This user does not exist"));

        $request['phone'] = $customer->phone;

        $request->validate([
            'phone' => ['required', 'exists:customers'],
        ]);
        if ($customer->block_flag === 1)
        {
            return $this->failure(__("Your account is blocked. Please contact support."));
        }
        $customer->sendOTP();
        return $this->success("Re-send otp is successfully", ["customer" => new CustomerResource($customer)]);
    }
    public function checkOTP(Request $request, Customer $customer)
    {
        $request->validate([
            'otp' => [
                'required',
                Rule::exists('customers')->where(function ($query) use ($customer) {
                    return $query->where('id', $customer->id);
                })
            ]
        ]);
        $customer->update([
            "otp" => null
        ]);
        $token = $customer->createToken('Personal access token to apis')->plainTextToken;

        return $this->success("verified successfully", ['token' => $token, "customer" => new CustomerResource($customer)]);
     }

    public function changePassword(Request $request, Customer $customer)
    {
        $request->validate([
            'password' => ['required', 'min:6', new PasswordNumberAndLetter()],
            'password_confirmation' => 'required|required_with:password|min:6|same:password',
        ]);

        $customer->update(['password' => $request->password]);

        return $this->success("password changed successfully");
    }
}

<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use App\Rules\IsActive;
use App\Rules\PasswordNumberAndLetter;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Rules\NotNumbersOnly;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\CustomerResource;
use App\Http\Resources\UserResource;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function loginByEmail(Request $request)
    {
        $request->validate([
            'email' => [
                'required',
                'email',
                'exists:customers,email',
                function ($attribute, $value, $fail) {
                    $customer = Customer::whereEmail($value)->first();
                     
                    if ($customer && $customer->block_flag === 1 )
                    {
                        $fail(__("Your account is blocked. Please contact support."));
                    }
                }
            ],
            'password' => 'required|min:6',
        ]);

        $customer = Customer::whereEmail($request->email)->first();

        if (Hash::check($request->password, $customer->password))
        {
            $token = $customer->createToken('Personal access token to apis')->plainTextToken;

            return $this->success("logged in successfully", ['token' => $token, "user" => new CustomerResource($customer)]);

        } else
        {
            return $this->validationFailure(["password" => [__("Password mismatch")]]);
        }
    }

    public function loginOTP(Request $request, Customer $customer)
    {
        $request['phone'] = $customer->phone;
        $request->validate([
            'phone' => ['required', 'exists:customers'],
            'otp' => [
                'required',
                Rule::exists('customers')->where(function ($query) use ($customer) {
                    return $query->where('id', $customer->id);
                })
            ],
        ]);

        $customer->update([
            "otp" => null
        ]);

        $customer->update(['fcm_token' => $request->fcm_token]);
        $token = $customer->createToken('Personal access token to apis')->plainTextToken;

        return $this->success("logged in successfully", ['token' => $token, "customer" => new CustomerResource($customer)]);
    }

    public function register(Request $request)
    {
        $data                        = $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg,gif,svg',
            'full_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],

            // 'first_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            // 'last_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'phone' => ['required', 'string', 'regex:/^[0-9]+$/', 'max:20', 'unique:customers'],
            'email' => 'required|string|email|unique:customers',
            'password' => ['required', 'string', 'min:8', 'max:255', new PasswordNumberAndLetter()],
            // 'password_confirmation' => 'required|same:password',
            'privacy_flag' => [
                'required',
                function ($attribute, $value, $fail) {
                    if ($value == 0 || $value == false || $value == "false")
                    {
                        $fail(__('Must be approved first'));

                    }
                }
            ],
            // 'power_attorney_flag' => [
            //     'required',
            //     function ($attribute, $value, $fail) {
            //         if ($value == 0 || $value == false || $value == "false")
            //         {
            //             $fail(__('Must be approved first'));

            //         }
            //     }
            // ],
        ]);
         $data['password_confirmation'] = $data['password']; // Remaining words as last_name or empty string if not provided

        $names = explode(' ', trim($data['full_name']), 2);
        $data['first_name'] = $names[0]; // First word as first_name
        $data['last_name'] = isset($names[1]) ? $names[1] : ''; // Remaining words as last_name or empty string if not provided

        $data['privacy_flag']        = $data['privacy_flag'] ? 1 : 0;
        $data['power_attorney_flag'] = 1;
        if ($request->image)
            $data['image'] = uploadImageToDirectory($request->file('image'), "Customers");
        $data['block_flag']       = 0;
        $customer                 = Customer::create($data);
        $customer->remember_token = Str::random(10);
        $customer->save();

        $customer->sendOTP();
        /* Mail::send('emails.otp',['user' =>  $customer],function($message) use($customer){
            $message->to($customer->email)->subject('Otp verification');
        }); */

        $token = $customer->createToken('Personal access token to apis')->plainTextToken;

        return $this->success("registered in successfully", ['token' => $token, "customer" => new CustomerResource($customer)]);
    }

    /* function socialLogin(Request $request) {
        $request->validate([
            'social_id' => "required",
        ]);

        $user = User::where('social_id', $request->social_id)->first();
        if($user)
        {
            $token = $user->createToken('Personal access token to apis')->accessToken;

            return $this->success("logged in successfully", ['token' => $token, "user" => new UserResource($user)]);
        }

        $request->validate([
            'name' => "required|string:255",
            'phone' => 'required|regex:/(^(05)([0-9]{8})$)/u|max:255',
            'email' => "required|email:255",
            'social_image_link' => "nullable",
            'fcm_token' => "required",
        ]);

        $user = User::create([
            'social_id' => $request->social_id,
            'name' => $request->name,
            'social_image_link' => $request->social_image_link,
            'fcm_token' => $request->fcm_token,
            'phone' => $request->phone,
            'email' => $request->email
        ]);
        $token = $user->createToken('Personal access token to apis')->accessToken;

        return $this->success("logged in successfully", ['token' => $token, "user" => new UserResource($user)]);
    } */

    public function logout(Request $request)
    {
        $token = $request->user()->token();
        $token->revoke();

        return $this->success('You have been successfully logged out!');
    }

}

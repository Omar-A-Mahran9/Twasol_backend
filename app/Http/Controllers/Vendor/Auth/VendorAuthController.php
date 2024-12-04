<?php

namespace App\Http\Controllers\Vendor\Auth;

use Carbon\Carbon;
use App\Models\Vendor;
use Illuminate\Http\Request;
use App\Enums\VendorStatusEnum;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class VendorAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:vendor')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.vendor_login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'   => 'required|email|exists:vendors',
            'password' => 'required|min:6'
        ]);
        $vendor = Vendor::where('email', $request->email)->withTrashed()->first();
        if ($vendor->deleted_at) {
            throw ValidationException::withMessages([
                "email" => __("Email is not activated"),
            ]);
        }
        if (
            $vendor->approved == VendorStatusEnum::Pending->value
            || $vendor->approved == VendorStatusEnum::Rejected->value
            || $vendor->approved == VendorStatusEnum::Blocking->value
        ) {
            throw ValidationException::withMessages([
                "email" => __("Email is not activated"),
            ]);
        }
        if (Auth::guard('vendor')->attempt($credentials, $request->has('remember_me'))) {
            $request->session()->regenerate();
            return response(['url' => redirect()->intended('/vendor/home')->getTargetUrl()]);
        } else {
            throw ValidationException::withMessages([
                "password" => __("The password is incorrect"),
            ]);
        }
        // return back();

        // return back()->withInput($request->only('email', 'remember'));
    }

    public function showResetForm($token)
    {
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', Hash::check($token, hashedValue: 'token'))
            ->first();
        if ($passwordReset) {
            $tokenCreatedAt = Carbon::parse($passwordReset->created_at);
            if ($tokenCreatedAt->addHours(24)->isPast()) {
                DB::table('password_reset_tokens')
                    ->where('token', Hash::check($token, hashedValue: 'token'))->delete();
                abort(404);
            }
        }
        abort_if(!$passwordReset, 404);

        // Pass the token to the view
        return view('auth.new_password', ['token' => $token]);
    }

    public function reset(Request $request)
    {
        // Validate the form input
        $request->validate([
            // 'email' => 'required|email',
            'password' => ['required', 'string', 'min:8', 'regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/', 'confirmed'],
            'password_confirmation' => ['required', 'same:password'],
            'token' => 'required',
        ]);

        // Find the password reset entry by token and email
        $passwordReset = DB::table('password_reset_tokens')
            ->where('token', Hash::check($request->token, hashedValue: 'token'))
            // ->where('email', $request->email)
            ->first();

        if (!$passwordReset) {
            return back()->withErrors(['email' => 'Invalid token or email.']);
        }

        $vendor = Vendor::where('email', $passwordReset->email)->first();

        $vendor->password = $request->password;
        $vendor->save();

        // Delete the reset record
        DB::table('password_reset_tokens')->where('token', Hash::check($request->token, 'token'))->delete();

        // Redirect or login the user
        // return redirect()->route('vendor.login');
        return response(['url' => redirect()->intended('/vendor/login')->getTargetUrl()]);
    }
    public function logout()
    {
        Auth::guard('vendor')->logout();
        return redirect()->route('vendor.login');
    }
}

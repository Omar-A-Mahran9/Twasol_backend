<?php

namespace App\Http\Controllers\Dashboard\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AdminAuthController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.admin_login');
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'   => 'required|email|exists:admins',
            'password' => 'required'
        ]);

        if (Auth::guard('admin')->attempt($credentials, $request->has('remember_me'))) {

            $request->session()->regenerate();
            return response(['url' => redirect()->intended('/dashboard')->getTargetUrl()]);
        }else{

            throw ValidationException::withMessages([
                "password" => __("The password is incorrect"),
            ]);
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
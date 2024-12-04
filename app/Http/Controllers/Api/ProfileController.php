<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\UpdateProfileInfoRequest;
use App\Http\Requests\Dashboard\UpdateProfileEmailRequest;
use App\Http\Requests\Dashboard\UpdateProfilePasswordRequest;
use App\Models\Admin;
use App\Models\Order;
use App\Rules\ExistPhone;
use App\Rules\NotNumbersOnly;
use App\Rules\PhoneNumber;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function profileInfo()
    {
        $admin = auth()->user();
         return $this->success('', [
            'admin' => $admin,
           
        ]);
    }

    public function updateInfo(Request $request)
    {
        $admin = auth()->user();

    // Validate the request data
    $data = $request->validate([
        'full_name' => ['required', 'string', 'max:255', new NotNumbersOnly()],
        'phone' => ['required', 'string', new PhoneNumber(), new ExistPhone(new Admin(), $admin->id), 'max:20', Rule::unique('admins')->ignore($admin->id)],
        'email' => ['required', 'string', 'email', Rule::unique('admins', 'email')->ignore($admin->id)],
        'image' => ['nullable', 'image', 'mimes:jpg,png,jpeg,gif,svg', 'max:512'], // Make 'image' optional
    ]);

    $names = explode(' ', trim($data['full_name']), 2);
    $data['first_name'] = $names[0]; // First word as first_name
    $data['last_name'] = isset($names[1]) ? $names[1] : ''; // Remaining words as last_name or empty string if not provided

    $admin->update($data);
    return response()->json(['message' => 'Profile updated successfully.']);


    }


    public function updateProfileEmail(UpdateProfileEmailRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update([
            'email' => $data['email']
        ]);
    }

    public function updatePassword(UpdateProfilePasswordRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update($data);
    }
}

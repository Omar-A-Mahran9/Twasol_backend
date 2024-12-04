<?php

namespace App\Http\Controllers\Dashboard;

use App\Enums\OrderStatus;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateProfileEmailRequest;
use App\Http\Requests\Dashboard\UpdateProfileInfoRequest;
use App\Http\Requests\Dashboard\UpdateProfilePasswordRequest;
use App\Models\Order;


class ProfileController extends Controller
{
    public function profileInfo()
    {
        $admin = auth()->user();
        return view('dashboard.profile-info', compact('admin'));
    }

    public function updateProfileInfo(UpdateProfileInfoRequest $request)
    {
        auth()->user()->update($request->validated());
    }


    public function updateProfileEmail(UpdateProfileEmailRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update([
            'email' => $data['email']
        ]);
    }

    public function updateProfilePassword(UpdateProfilePasswordRequest $request)
    {
        $admin = auth()->user();

        $data = $request->validated();

        $admin->update($data);
    }
}

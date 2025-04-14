<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UpdateHomeSettingsRequest;
use App\Models\PaymentMethod;
use App\Models\PaymentWay;
use App\Rules\NotNumbersOnly;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.index');
        }
    }

    public function aboutUs(UpdateHomeSettingsRequest $request)
    {
        // Check if it's a GET request — show the form
        if ($request->isMethod('get')) {
            $this->authorize('view_settings');
            return view('dashboard.settings.home.about-us');
        }

        // Otherwise, handle POST submission
        $data = $request->validated();

        // If a new image is uploaded, handle the upload
        if ($request->hasFile('about_us_image')) {
            deleteImageFromDirectory(setting('about_us_image'), "Settings");
            $data['about_us_image'] = uploadImageToDirectory($request->file('about_us_image'), "Settings");
        }

        // Save the updated settings
        setting($data)->save();

        // Redirect back with a success message (optional)
        return redirect()->back()->with('success', 'About Us settings updated successfully.');
    }
    public function terms(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.terms');
        }
    }

    public function privacyPolicy(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.privacy-policy');
        }
    }
    public function ourmission(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.our-mission');
        }
    }

    public function ourvission(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.our-vission');
        }
    }



}

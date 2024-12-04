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
    public function paymentWay()
    {
        $payment=PaymentWay::get();
        return view('dashboard.settings.home.payment-way',compact('payment'));
    }

    public function paymentpartener()
    {
        $payment=PaymentMethod::get();
        return view('dashboard.settings.home.payment-partener',compact('payment'));
    }

    public function paymentWaystore(Request $request)
    {
        // Validation rules
        $data=$request->validate([
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
        'name_ar' => ['required', 'string', 'max:255', 'unique:payment_ways,name_ar', new NotNumbersOnly()],
                'name_en' => ['required', 'string', 'max:255', 'unique:payment_ways,name_en', new NotNumbersOnly()],
            'description_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'description_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'statue' => 'required|in:pending,inactive,active',
        ]);

        $data['image'] = uploadImageToDirectory($request->file('image'), "paymentway");

        PaymentWay::create($data);

        return response(["payment created successfully"]);
    }
    public function paymentpartenerstore(Request $request)
    {
        // Validation rules
        $data=$request->validate([
                 'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:512',
                 'name_ar' => ['required', 'string', 'max:255', 'unique:payment_methods,name_ar', new NotNumbersOnly()],
                'name_en' => ['required', 'string', 'max:255', 'unique:payment_methods,name_en', new NotNumbersOnly()],

            'statue' => 'required|in:pending,inactive,active',
        ]);

        $data['image'] = uploadImageToDirectory($request->file('image'), "PaymentPartener");

        PaymentMethod::create($data);

        return response(["payment created successfully"]);
    }
    public function updatestatue($id, Request $request)
    {
        // Get the new status ('active' or 'inactive') from the request
        $status = $request->input('statue');  
    
        // Find the payment way by ID
        $paymentWay = PaymentMethod::findOrFail($id);  
    
        // Update the statue field (assuming 'statue' is a column in your database)
        $paymentWay->statue = $status;  
        $paymentWay->save();  // Save the updated payment way
    
        // Return a success response with a message
        return response()->json(['message' => 'Status updated successfully!']);
    }

    public function updatestatuePaymentWay($id, Request $request)
    {
        // Get the new status ('active' or 'inactive') from the request
        $status = $request->input('statue');  
    
        // Find the payment way by ID
        $paymentWay = PaymentWay::findOrFail($id);  
    
        // Update the statue field (assuming 'statue' is a column in your database)
        $paymentWay->statue = $status;  
        $paymentWay->save();  // Save the updated payment way
    
        // Return a success response with a message
        return response()->json(['message' => 'Status updated successfully!']);
    }
    
    public function deletepaymentWay($id)
{
    $payment = PaymentWay::findOrFail($id);
    $payment->delete();

    return response()->json(['message' => 'Payment deleted successfully']);
}

    
    
    
    
    public function aboutUs(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.about-us');
        }
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
    public function returnPolicy(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.return-policy');
        }
    }

    public function loyality(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.loyality');
        }
    }

        public function HomeController(UpdateHomeSettingsRequest $request)
    {
        if ($request->isMethod('post'))
        {
            setting($request->validated())->save();
        } else
        {
            $this->authorize('view_settings');

            return view('dashboard.settings.home.return-policy');
        }
    }
}

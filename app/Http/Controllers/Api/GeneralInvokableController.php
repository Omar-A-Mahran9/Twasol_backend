<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\SliderResource;
use App\Models\Slider;
use Illuminate\Http\Request;

class GeneralInvokableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $gallary   = Gallary::select('id', 'name_ar', 'name_en','image')->get();
        // $ourservices = AddonService::select('id', 'name_ar', 'name_en', 'image', 'description_ar', 'description_en')
        // ->orderBy('created_at', 'asc') // Order by the oldest created records
        // ->get();

            $slider     = Slider::select('id', 'title_ar', 'title_en')->get();
        //  $rate         = customers_rates::select('id', 'customer_id','comment','rate','status')->get();
        //  $parteners=partener::select('id', 'name_ar', 'name_en','image')->get();
            return $this->success('', [

            'slider' => SliderResource::collection($slider),
            // 'partners'=>PartenersResource::collection($parteners),
            // 'gallary'=>GallariesResource::collection($gallary),

            // 'Rate' => RateResource::collection( $rate),
            // 'services'=> ServiceResource::collection($ourservices),

            'instagram_link' => setting('instagram_link'),
            'privacy_policy' => setting('privacy_policy_' . request()->header('Content-language')),
            'facebook_link' => setting('facebook_link'),
            'snapchat' => setting('linkedin_link'),
            'youtube_link' => setting('youtube_link'),
            'tiktok_link' =>  setting('tiktok_link'),
            'twitter_link' => setting('twitter_link'),
            'whatsapp_number' => setting('whatsapp_number'),
            'sms_number' => setting('sms_number'),
            'email' => setting('email'),
            'address_ar' => setting('address_ar'),
            'address_en' => setting('address_en'),
            'whatsapp_message_time' => setting('delay_time_seconds'),
            'whatsapp_message' => setting('whatsapp_message'),
            'whatsapp_show' => setting('whatsapp_notification_enabled'),
            'about_us' => [
                'label' => setting('label_' . request()->header('Content-language')),
                'description' => setting('about_us_' . request()->header('Content-language')),
                'video' => setting('youtube_link')

            ],
            'terms_and_condition' => setting('terms_' . request()->header('Content-language')),
            'return_policy' => setting('return_policy_' . request()->header('Content-language')),
            'loyality' => setting('loyality_' . request()->header('Content-language')),

            'tax' => (setting('tax') / 100),

        ]);
    }
}

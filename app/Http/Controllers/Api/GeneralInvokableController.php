<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\BrandResource;
use App\Http\Resources\Api\CategoryResource;
use App\Http\Resources\Api\CityResource;
use App\Http\Resources\Api\CustomerRateResource;
use App\Http\Resources\Api\GallariesResource;
use App\Http\Resources\Api\packagesCategoryResources;
use App\Http\Resources\Api\PartenersResource;
use App\Http\Resources\Api\Rate;
use App\Http\Resources\Api\RateResource;
use App\Http\Resources\Api\ServiceResource;
use App\Http\Resources\Api\SkinColorResource;
use App\Models\AddonService;
use App\Models\Brand;
use App\Models\Category;
use App\Models\City;
use App\Models\customers_rates;
use App\Models\Gallary;
use App\Models\PackageCategory;
use App\Models\partener;
use App\Models\SkinColor;
use Illuminate\Http\Request;

class GeneralInvokableController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $gallary   = Gallary::select('id', 'name_ar', 'name_en','image')->get();
        $ourservices = AddonService::select('id', 'name_ar', 'name_en', 'image', 'description_ar', 'description_en')
        ->orderBy('created_at', 'asc') // Order by the oldest created records
        ->get();

            $allCities     = City::select('id', 'name_ar', 'name_en')->get();
         $rate         = customers_rates::select('id', 'customer_id','comment','rate','status')->get();
         $parteners=partener::select('id', 'name_ar', 'name_en','image')->get();
            return $this->success('', [

            'allCities' => CityResource::collection($allCities),
            'gallary'=>GallariesResource::collection($gallary),

            'Rate' => RateResource::collection( $rate),
            'services'=> ServiceResource::collection($ourservices),
            'partners'=>PartenersResource::collection($parteners),
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

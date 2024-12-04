<?php

use Illuminate\Support\Facades\Http;
// use Webstdy\Notification\NewNotification;

if(!function_exists('isNavTabActive')){

    function isNavTabActive($path){
        if(request()->segment(1) == null && $path == "/"){
            return 'active';
        }
        else if ( request()->segment(1)  === $path)
            return 'active';
    }
}

if(!function_exists('storeAndPushNotificationInHome')){

    function storeAndPushNotificationInHome($titleAr, $titleEn, $descriptionAr, $descriptionEn, $icon, $color, $url)
    {
        $date = Carbon::now()->diffForHumans();
        $notification = new NewNotification($titleAr, $titleEn, $descriptionAr, $descriptionEn, $date, $icon, $color, $url);
        $user = auth()->user();
        $user->notify($notification);

        /* push notifications to all users */
        $firebaseToken = auth()->user()->whereNotNull('device_token')->pluck('device_token')->all();
        $SERVER_API_KEY = "AAAAdaClkUc:APA91bFvu0zGXOeq2_lBLwoHBUGH37Bdk_zBjh8Dg__55nmsWRtwk_njpEzCLc29Ik5S2KHW34vxNiQb2RcihiEJXZVPh8A3FPawZPxVH_MDf06x06VzBPXEt7iKhTur4tbzzg_RD_8H"; //use your server api key

        $data = [
            "registration_ids" => $firebaseToken,
            "notification" => [
                "alert_title" => app()->getLocale() == 'en' ? $titleEn : $titleAr,
                "title" => app()->getLocale() == 'en' ? $titleEn : $titleAr,
                "description" => json_encode(['ar' => $descriptionAr, 'en' => $descriptionEn]),
                "body" => json_encode(['ar' => $descriptionAr, 'en' => $descriptionEn]),
                "date" => $date,
                "alert_icon" => $icon ,
                "icon" => asset(getImagePathFromDirectory(setting('fav_icon'), 'Settings')),
                "icon_color" => $color,
                "url" => $url,
                "id" => $user->notifications->last()->id,
            ],
            "webpush" => [
                "fcm_options" => [
                    "link" => $url
                ]
            ]
        ];

        return Http::withHeaders([
            "Authorization" => "key=$SERVER_API_KEY",
        ])->post('https://fcm.googleapis.com/fcm/send', $data);
    }
}

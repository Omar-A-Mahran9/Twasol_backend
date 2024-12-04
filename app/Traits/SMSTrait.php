<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SMSTrait
{
    protected function sendSMS($message)
    {
        $response = Http::get("", [
            'userName' => "",
            'userSender' => "",
            'numbers' => $this->full_phone,
            'msg' => $message,
            'apiKey' => "1A90242981779682FDF587C0618F3650",
        ]);

        return $response->body();
    }
}

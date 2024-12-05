<?php

return [
    'secret_key' => env('TAP_PAYMENT_SECRET_API_KEY'),
    'secret_key_market_place' => env('TAP_PAYMENT_SECRET_API_KEY_MARKET_PLACE'),
    'create_recharge_base_url' => env('TAP_PAYMENT_CREATE_CHARGE_BASE_URL', 'https://api.tap.company/v2/charges/'),
    'merchant_id' => env('TAP_PAYMENT_MERCHANT_ID'),
    // 'redirection_url' => 'https://alraqi.sa/', /*'http://localhost:3000/checkout'*/
    // 'redirection_url' => 'http://localhost:3000/checkout', /*'http://localhost:3000/checkout'*/
];

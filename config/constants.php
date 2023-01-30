<?php

return [
    'TEMP_IMAGES' => 'temp_images/',
    'ADMIN_PATH' => "admin/",

    'IMAGE_UPLOAD_PRICE' => 4.99,

    'STRIPE_MODE' => env('STRIPE_MODE', 'live'),
    'STRIPE_PK_TEST' => env('STRIPE_PK_TEST'),
    'STRIPE_SK_TEST' => env('STRIPE_SK_TEST'),
    'STRIPE_PK_LIVE' => env('STRIPE_PK_LIVE'),
    'STRIPE_SK_LIVE' => env('STRIPE_SK_LIVE'),
];

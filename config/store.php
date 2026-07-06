<?php

return [
    'name' => env('APP_NAME', 'UD Trisna Putra'),
    'address' => env('COMPANY_ADDRESS', ''),
    'phone' => env('COMPANY_PHONE', ''),
    'latitude' => env('STORE_LATITUDE', null),
    'longitude' => env('STORE_LONGITUDE', null),
    'delivery_radius_km' => env('DELIVERY_RADIUS_KM', 5),
    'shipping_fee' => env('SHIPPING_FEE', 15000),
];

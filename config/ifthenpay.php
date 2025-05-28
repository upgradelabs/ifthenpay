<?php

return [
    'sandbox' => env('IFTHENPAY_SANDBOX', false),

    'mb_key' => env('IFTHENPAY_MB_KEY'),
    'multibanco' => [
        'init' => 'https://ifthenpay.com/api/multibanco/reference/init',
        'sandbox' => 'https://ifthenpay.com/api/multibanco/reference/sandbox',
    ],

    'mbway_key' => env('IFTHENPAY_MBWAY_KEY'),
    'mbway' => [
        'endpoint' => 'https://api.ifthenpay.com/spg/payment/mbway',
        'status_endpoint' => 'https://api.ifthenpay.com/spg/payment/mbway/status',
    ],

    'ccard_key' => env('IFTHENPAY_CCARD_KEY'),
    'creditcard' => [
        'base_url' => 'https://ifthenpay.com/api/creditcard/init',
    ],

    'gateway_key' => env('IFTHENPAY_GATEWAY_KEY'),
    'pinpay' => [
        'base_url' => 'https://api.ifthenpay.com/gateway/pinpay',
    ],

    'google_key' => env('IFTHENPAY_GOOGLE_KEY'),
    'apple_key' => env('IFTHENPAY_APPLE_KEY'),

    'backoffice_key' => env('IFTHENPAY_BACKOFFICE_KEY'),
    'refund' => [
        'endpoint' => 'https://ifthenpay.com/api/endpoint/payments/refund',
    ],
];

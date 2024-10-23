<?php

// SSLCommerz configuration

$apiDomain = env('SSLCZ_TESTMODE', true) ? "https://sandbox.sslcommerz.com" : "https://securepay.sslcommerz.com";

return [
    'apiCredentials' => [
        'store_id' => env('SSCOMMERZ_STORE_ID'),
        'store_password' => env('SSCOMMERZ_STORE_PASSWORD'),
    ],
    'apiUrl' => [
        'make_payment' => "/gwprocess/v4/api.php",
        'transaction_status' => "/validator/api/merchantTransIDvalidationAPI.php",
        'order_validate' => "/validator/api/validationserverAPI.php",
        'refund_payment' => "/validator/api/merchantTransIDvalidationAPI.php",
        'refund_status' => "/validator/api/merchantTransIDvalidationAPI.php",
    ],
    'apiDomain' => $apiDomain,
    'connect_from_localhost' => env("IS_LOCALHOST", true), // For Sandbox testing, set to true
    'success_url' => '/student/student/payment/success',
    'failed_url' => '/fail',
    'cancel_url' => '/cancel',
    'ipn_url' => '/ipn',
];


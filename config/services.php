<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'eazy_pay' => [
        'app_id' => env('EAZY_PAY_APP_ID'),
        'merchant_id' => env('EAZY_PAY_MERCHANT_ID'),
        'secret_key' => env('EAZY_PAY_SECRET_KEY'),
        'endpoint' => env('EAZY_PAY_ENDPOINT'),
        'webhook_url' => env('EAZY_PAY_WEBHOOK_URL'),
        'return_url' => env('EAZY_PAY_RETURN_URL'),
    ],

];

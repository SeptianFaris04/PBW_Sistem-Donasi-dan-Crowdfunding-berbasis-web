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
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    # API Google
    // GOOGLE_CLIENT_ID="386126898030-q92s6ros8o9o6thgqc3ou997ejn6v1br.apps.googleusercontent.com"
    // GOOGLE_CLIENT_SECRET="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"
    // # GOOGLE_REDIRECT_URL="http://127.0.0.1:8000/callback"
    // GOOGLE_REDIRECT_URL="https://redirectmeto.com/https://web_donasi_crowdfunding.test/callback"

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URL'),
    ],

    // MIDTRANS_SERVER_KEY=SB-Mid-server-Zh5KAKjPmrq4WPlenhhljNdb
    // MIDTRANS_CLIENT_KEY=SB-Mid-client-mwgHlUDAO4rIbYGD
    // MIDTRANS_IS_PRODUCTION=false
    // MIDTRANS_IS_SANITIZED=true
    // MIDTRANS_IS_3DS=true

    'midtrans' => [
        'MerchantID' => env('MIDTRANS_MERCHANT_ID'),
        'serverKey' => env('MIDTRANS_SERVER_KEY'),
        'clientKey' => env('MIDTRANS_CLIENT_KEY'),
        'isProduction' => env('MIDTRANS_IS_PRODUCTION', false),
        'isSanitized' => env('MIDTRANS_IS_SANITIZED', true),
        'is3DS' => env('MIDTRANS_IS_3DS', true)
    ],
];

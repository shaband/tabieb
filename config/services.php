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

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'tokbox' => [
        'key' => env('TOKBOX_KEY', null),
        'secret' => env('TOKBOX_SECRET', null),
    ],
    'facebook' => [
        'client_id' => env('FACEBOOK_CLIENT_ID', null),
        'client_secret' => env('FACEBOOK_CLIENT_SECRET', null),
        'redirect' => env('FACEBOOK_CALLBACK', null),
    ],
    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID', null),
        'client_secret' => env('GOOGLE_CLIENT_SECRET', null),
        'redirect' => env('GOOGLE_CALLBACK', null),
    ],


    'paytabs' => [
        'merchant_email' => env("PAYTABS_MERCHANT_EMAIL", 'mahmoudshaband@gmail.com'),
        'merchant_id' => env("PAYTABS_MERCHANT_ID", '10043732'),
        'secret_key' => env("PAYTABS_SECRET_KEY", '4gVvb27xiKgweYerAhIXi3ER67FKTCBXTws4zABSkSpyQE0qVIoeM25T9LD2of0hMsmm2YfnQEVHiW8eFwsszylJjZLIeL01emnh'),
        'redirect' => env('PAYTABS_CALLBACK', "https://tabieb.test/paytabs/callback")
    ]
    /*'twitter' => [
        'client_id' => env('TWITTER_CLIENT_ID',null),
        'client_secret' => env('TWITTER_CLIENT_SECRET',null),
        'redirect' =>  env('TWITTER_CALLBACK',null),
    ],
    'github' => [
        'client_id' => env('GITHUB_CLIENT_ID',null),
        'client_secret' => env('GITHUB_CLIENT_SECRET',null),
        'redirect' =>  env('GITHUB_CALLBACK',null),
    ],*/
];

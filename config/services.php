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
        'merchant_email' => env("PAYTABS_MERCHANT_EMAIL", 'info@tabayib.com'),
        'merchant_id' => env("PAYTABS_MERCHANT_ID", '10063929'),
        'secret_key' => env("PAYTABS_SECRET_KEY", 'CsV6Rq0BHam50so4SEisW6F2R3A2U6zxyvDqWE2DPpIPR6UKLddHjSJbVkePqNnZj0qfFtSuSBkKIeutsHaMzUXvfblGZIGiJ6yo'),
        'redirect' => env('PAYTABS_CALLBACK', "https://tabayib.com/paytabs/callback"),
        'site_url'=>env("PAYTABS_SITE_URL",'tabayib.com')
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

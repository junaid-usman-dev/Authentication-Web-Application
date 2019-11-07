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


    /*
    |--------------------------------------------------------------------------
    | Social Linkes Configrations
    |--------------------------------------------------------------------------
    |   Facebook, Google Account, Github, LinkedIn and etc Login Integration 
    |   and Configration
    | 
    */
    'facebook' => [
        'client_id'     => '558769188214275',
        'client_secret' => '8f65a67053c482b398f077d7348bb043',
        'redirect'      => 'http://localhost:8000/login/facebook/callback',
    ],

    'twitter' => [
            'client_id'     => env('TWITTER_CLIENT_ID'),
            'client_secret' => env('TWITTER_CLIENT_SECRET'),
            'redirect'      => env('TWITTER_URL'),
    ],

    'github' => [
        'client_id'     => env('GITHUB_CLIENT_ID'),
        'client_secret' => env('GITHUB_CLIENT_SECRET'),
        'redirect'      => env('GITHUB_URL'),
    ],
    
    'google' => [
        'client_id'     => '965629471819-8fe2miipo8ou4dnp41h960a1tohc6sui.apps.googleusercontent.com',
        'client_secret' => 'nOirFxENg0xRhYEY2LCtJO2O',
        'redirect'      => 'http://127.0.0.1:8000/login/google/callback',
    ],

];


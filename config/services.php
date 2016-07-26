<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],

    'spotify' => [
        'client_id' => '1dc1b1957b9749798ccb2443391ba56b',
        'client_secret' => '4830497131824174b89c851896eb6788',
        'redirect' => 'http://www.localhost:8080/proyectotfg/public/auth/spotify/callback',  
    ],

    'twitter' => [
        'client_id' => 'yinKg5lw1d4RnGuGvgqvvfLwk',
        'client_secret' => '2o46A5KnyYzZJgVReXOoEEmCoXXOMjOWcLZwQfyl1ClMBtNPUv',
        'redirect' => 'http://localhost:8080/proyectotfg/public/auth/twitter/callback',
    ],

];

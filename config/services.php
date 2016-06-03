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
        'domain' => '',
        'secret' => '',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key'    => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model'  => App\User::class,
        'key'    => '',
        'secret' => '',
    ],

    'twitter' => [
        'client_id' => '06v1mMIUvdG5bxZ4xf32PAhrZ',
        'client_secret' => '55qlKtZLjnnfHRBEyaGPOk2SclgW5ZXfG8dQh4TGxXHWbwdRgV',
        'redirect' => 'http://calova.id/api/auth/twitter/callback',
    ],

    'facebook' => [
        'client_id' => '1479701339013270',
        'client_secret' => 'f8d868e004c54395eedb9ec16154abab',
        'redirect' => 'http://calova.id/api/auth/facebook/callback',
    ],

];

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

    'kimonolabs' => [
        'api_key' => env('KIMONOLABS_API_KEY'),
    ],

    'parse' => [
        'app_id'     => env('PARSE_APP_ID'),
        'rest_key'   => env('PARSE_REST_KEY'),
        'master_key' => env('PARSE_MASTER_KEY'),
    ],

];

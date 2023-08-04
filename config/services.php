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
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'firebase' => [
        'database_url' => 'https://leuleu-12458-default-rtdb.asia-southeast1.firebasedatabase.app/',
        'api_key' => 'AIzaSyCiNbk3tJIBVYJQ22aZb2XSSqfZwGuRaOc',
        'auth_domain' => 'leuleu-12458.firebaseapp.com',
        'project_id' => 'leuleu-12458',
        'storage_bucket' => 'leuleu-12458.appspot.com',
        'messaging_sender_id' => '814485314103',
        'app_id' => '1:814485314103:web:d7be8dc6a33bd600ea7db2',
        'measurement_id' => 'G-VNXB96PLBX',
        'credentials_path' => 'serviceAccount.json'
    ],
];

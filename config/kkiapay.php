<?php

return [
    /*
    |--------------------------------------------------------------------------
    | KKiaPay Configuration
    |--------------------------------------------------------------------------
    */

    'public_key' => env('KKIAPAY_PUBLIC_KEY'),
    'private_key' => env('KKIAPAY_PRIVATE_KEY'),
    'secret' => env('KKIAPAY_SECRET'),
    'sandbox' => env('KKIAPAY_SANDBOX', true),
    'webhook_url' => env('KKIAPAY_WEBHOOK_URL'),
    
    /*
    |--------------------------------------------------------------------------
    | KKiaPay API URLs
    |--------------------------------------------------------------------------
    */
    
    'api_url' => env('KKIAPAY_SANDBOX', true) 
        ? 'https://api.kkiapay.me' 
        : 'https://api.kkiapay.me',
    
    /*
    |--------------------------------------------------------------------------
    | Payment Settings
    |--------------------------------------------------------------------------
    */
    
    'currency' => 'XOF', // FCFA
    // Le callback n'est pas nécessaire en mode widget car on gère avec les listeners
    'callback_url' => env('APP_URL'),
];
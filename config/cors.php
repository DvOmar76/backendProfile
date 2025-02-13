<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure your settings for cross-origin resource sharing
    | or "CORS". This determines what cross-origin operations may execute
    | in web browsers. You are free to adjust these settings as needed.
    |
    | To learn more: https://developer.mozilla.org/en-US/docs/Web/HTTP/CORS
    |
    */

//    'paths' => ['api/*','storage/*'],
//
//    'allowed_methods' => ['*'],
//
//    'allowed_origins' => ['*'],
//
//    'allowed_origins_patterns' => [],
//
//    'allowed_headers' => ['*'],
//
//    'exposed_headers' => [],
//
//    'max_age' => 0,
//
//    'supports_credentials' => true,
    // 'paths' => ['api/*','/login' ,'sanctum/csrf-cookie'], // Add your paths here
    // 'allowed_methods' => ['*'],  // Allow all HTTP methods
    // 'allowed_origins' => ['http://localhost:3000'], // Allow your frontend's origin
    // 'allowed_origins_patterns' => [],
    // 'allowed_headers' => ['*'],  // Allow all headers
    // 'exposed_headers' => [],
    // 'max_age' => 0,
    // 'supports_credentials' => true,  // Enable


    'paths' => ['api/*', 'sanctum/csrf-cookie'],  // Add your api paths here

    'allowed_methods' => ['*'],  // Allow all methods (GET, POST, PUT, DELETE, etc.)

    'allowed_origins' => ['http://localhost:3000'],  // Replace with your frontend URL

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],  // Allow all headers

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => true,  // If using cookies or credentials

];

<?php

// config/cors.php

return [

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS) Configuration
    |--------------------------------------------------------------------------
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie', 'login', 'logout', 'register'],

    'allowed_methods' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'OPTIONS'],

    'allowed_origins' => [
        'https://v0.app/chat/pems-2-0-admin-dashboard-pmZ3Cw3C6Ne',
        'https://pems-webapp.vercel.app',
        // Development
        'http://localhost:3000',
        'http://localhost:3003',
        'http://localhost:5173',
    ],

    'allowed_origins_patterns' => [
        // Match any v0.app subdomain if needed
        '#^https://.*\.v0\.app$#',
        // Match Vercel preview deployments
        '#^https://pems-webapp.*\.vercel\.app$#',
    ],

    'allowed_headers' => [
        'Content-Type',
        'Authorization',
        'X-Requested-With',
        'Accept',
        'Origin',
        'X-CSRF-TOKEN',
        'X-XSRF-TOKEN',
    ],

    'exposed_headers' => ['Content-Range', 'X-Content-Range'],

    'max_age' => 86400, // 24 hours

    'supports_credentials' => true,

];
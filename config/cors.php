<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Laravel CORS Configuration
    |--------------------------------------------------------------------------
    |
    | Pengaturan ini menentukan dari mana request API boleh datang.
    | Ubah sesuai alamat frontend kamu.
    |
    */

    'paths' => ['api/*', 'sanctum/csrf-cookie'],

    'allowed_methods' => ['*'],

    // ganti ke alamat FE kamu, misal port 8001
    'allowed_origins' => ['http://127.0.0.1:8001'],

    'allowed_origins_patterns' => [],

    'allowed_headers' => ['*'],

    'exposed_headers' => [],

    'max_age' => 0,

    'supports_credentials' => false,

];

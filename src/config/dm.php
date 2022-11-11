<?php

return [
    'dm' => [
        'driver'         => 'dm',
        'tns'            => env('DB_TNS', ''),
        'host'           => env('DB_HOST', ''),
        'port'           => env('DB_PORT', '5237'),
        'database'       => env('DB_DATABASE', ''),
        'username'       => env('DB_USERNAME', ''),
        'password'       => env('DB_PASSWORD', ''),
        'charset'        => env('DB_CHARSET', 'UTF8'),
        'prefix'         => env('DB_PREFIX', ''),
    ],
];

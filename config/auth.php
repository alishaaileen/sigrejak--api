<?php

return [
    'defaults' => [
        'guard' => 'api',
        'passwords' => 'users',
    ],

    'guards' => [
        'api' => [
            'driver' => 'jwt',
            'provider' => 'users',
        ],
        'admin' => [
            'driver' => 'jwt',
            'provider' => 'admins',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Keluarga::class
        ],
        'admins' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Admin::class
        ],
    ]
];

// D6XhPpUz4uKQlggm4vq6FgW3I8ve5mHOfSGdbLQg
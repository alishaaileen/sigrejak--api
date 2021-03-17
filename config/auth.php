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
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Keluarga::class
        ]
    ]
];

// D6XhPpUz4uKQlggm4vq6FgW3I8ve5mHOfSGdbLQg
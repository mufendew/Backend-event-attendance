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
        'organizer' => [
            'driver' => 'jwt',
            'provider' => 'organizers',
        ],
    ],

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => \App\Models\User::class
        ],
        'organizers' => [
            'driver' => 'eloquent',
            'model' => \App\Models\Organizer::class
        ]
    ]
];
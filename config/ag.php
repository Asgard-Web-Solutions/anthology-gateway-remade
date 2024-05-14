<?php

return [
    'icons' => [
        'publisher' => env('ICON_PUBLISHER', 'fa-duotone fa-typewriter'),
        'anthology' => env('ICON_ANTHOLOGY', 'fa-duotone fa-book'),
        'author' => env('ICON_AUTHOR', 'fa-duotone fa-user-astronaut'),
        'team' => env('ICON_TEAM', 'fa-duotone fa-people-group'),
        'edit' => env('ICON_EDIT', 'fa-light fa-pen-to-square'),
        'delete' => env('ICON_DELETE', 'fa-regular fa-trash-can'),
        'unbookmarked' => env('ICON_UNBOOKMARKED', 'fa-regular fa-bookmark'),
        'bookmarked' => env('ICON_BOOKMARKED', 'fa-duotone fa-bookmark'),
    ],
    'limits' => [
        'team_silver' => env('LIMIT_TEAM_SILVER', '2'),
        'team_gold' => env('LIMIT_TEAM_GOLD', '5'),
        'team_diamond' => env('LIMIT_TEAM_DIAMOND', '10'),

        'submissions_silver' => env('SUBMISSIONS_SILVER', '10'),
        'submissions_gold' => env('SUBMISSIONS_GOLD', '99'),
        'submissions_diamond' => env('SUBMISSIONS_DIAMOND', '250'),

        'open_days_silver' => env('OPEN_DAYS_SILVER', '15'),
        'open_days_gold' => env('OPEN_DAYS_GOLD', '60'),
        'open_days_diamond' => env('OPEN_DAYS_DIAMOND', '120'),

        'data_retention_silver' => env('DATA_RETENTION_SILVER', '180'),
        'data_retention_gold' => env('DATA_RETENTION_GOLD', '365'),
        'data_retention_diamond' => env('DATA_RETENTION_DIAMOND', '730'),
    ],
];

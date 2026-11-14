<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Subscription catalog (display only)
    |--------------------------------------------------------------------------
    |
    | The landing site only advertises the plans — checkout happens on the app
    | (see app.app_url). Prices are integer minor units (cents) and must mirror
    | the app's Stripe catalog. Localized names, descriptions and features live
    | in lang/<locale>/billing.php under billing.plans.<slug>.
    |
    */

    /*
    |--------------------------------------------------------------------------
    | Early access
    |--------------------------------------------------------------------------
    |
    | While enabled, the app is free and the landing hides plans and prices,
    | showing the early-access section instead. Must mirror the app's own
    | early-access switch. Turn it off once paid plans launch.
    |
    */

    'early_access' => (bool) env('NUMIBOO_EARLY_ACCESS', false),

    'currency' => 'EUR',

    'trial_days' => 7,

    'trial_exercises' => 20,

    'plans' => [
        [
            'slug' => 'starter',
            'recommended' => false,
            'prices' => [
                'monthly' => 399,
                'yearly' => 2999,
            ],
        ],
        [
            'slug' => 'premium',
            'recommended' => true,
            'prices' => [
                'monthly' => 699,
                'yearly' => 4999,
            ],
        ],
    ],

];

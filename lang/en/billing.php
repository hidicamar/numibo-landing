<?php

declare(strict_types=1);

return [
    'pricing' => [
        'title' => 'Choose your plan',
        'monthly' => 'Monthly',
        'yearly' => 'Yearly',
        'per_month' => '/ month',
        'per_year' => '/ year',
        'trial_notice' => 'Every plan starts with a :days-day free trial that includes :count exercise generations.',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter',
            'description' => 'Everything you need to practise math with your kids.',
            'features' => [
                'Unlimited worksheet generation',
                'All exercise types for grades 1–5',
                'Interactive online solving',
                'Printable PDF worksheets with solutions',
            ],
        ],
        'premium' => [
            'name' => 'Premium',
            'description' => 'Everything in Starter, plus full insight into practice progress.',
            'features' => [
                'Everything in Starter',
                'Exercise history',
                'Attempt statistics and progress',
            ],
        ],
    ],
];

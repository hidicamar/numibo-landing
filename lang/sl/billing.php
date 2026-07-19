<?php

declare(strict_types=1);

return [
    'pricing' => [
        'title' => 'Izberi svoj paket',
        'monthly' => 'Mesečno',
        'yearly' => 'Letno',
        'per_month' => '/ mesec',
        'per_year' => '/ leto',
        'trial_notice' => 'Vsak paket se začne z :days-dnevnim brezplačnim preizkusom, ki vključuje :count ustvarjanj vaj.',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter',
            'description' => 'Vse, kar potrebuješ za vadbo matematike s svojimi otroki.',
            'features' => [
                'Neomejeno ustvarjanje delovnih listov',
                'Vse vrste vaj za 1.–5. razred',
                'Interaktivno reševanje v brskalniku',
                'Delovni listi PDF za tiskanje z rešitvami',
            ],
        ],
        'premium' => [
            'name' => 'Premium',
            'description' => 'Vse iz paketa Starter in popoln vpogled v napredek vadbe.',
            'features' => [
                'Vse iz paketa Starter',
                'Zgodovina vaj',
                'Statistika poskusov in napredek',
            ],
        ],
    ],
];

<?php

declare(strict_types=1);

return [
    'pricing' => [
        'title' => 'Odaberi svoj paket',
        'monthly' => 'Mjesečno',
        'yearly' => 'Godišnje',
        'per_month' => '/ mjesec',
        'per_year' => '/ godina',
        'trial_notice' => 'Svaki paket počinje s :days-dnevnim besplatnim probnim razdobljem koje uključuje :count generiranja vježbi.',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter',
            'description' => 'Sve što ti treba za vježbanje matematike sa svojom djecom.',
            'features' => [
                'Neograničeno kreiranje radnih listova',
                'Sve vrste vježbi za 1.–5. razred',
                'Interaktivno online rješavanje',
                'PDF radni listovi za ispis, po želji s rješenjima',
            ],
        ],
        'premium' => [
            'name' => 'Premium',
            'description' => 'Sve iz paketa Starter, plus vježbe s vremenskim ograničenjem, dječji profili i nagrade.',
            'features' => [
                'Sve iz paketa Starter',
                'Povijest vježbi',
                'Pokušaji, rezultati i vrijeme rješavanja',
                'timed_exercises' => 'Vježbe s vremenskim ograničenjem',
                'child_profiles' => 'Do 4 dječja profila',
                'rewards' => 'Zvjezdice, tjedni niz i značke',
            ],
        ],
    ],
];

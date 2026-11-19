<?php

declare(strict_types=1);

return [
    'pricing' => [
        'title' => 'Odaberi svoj paket',
        'monthly' => 'Mjesečno',
        'yearly' => 'Godišnje',
        'per_month' => '/ mjesec',
        'per_year' => '/ godina',
        'trial_notice' => 'Svaki paket počinje s :days-dnevnim besplatnim probnim periodom koji uključuje :count generisanja vježbi.',
    ],

    'plans' => [
        'starter' => [
            'name' => 'Starter',
            'description' => 'Sve što ti treba za vježbanje matematike sa svojom djecom.',
            'features' => [
                'Neograničeno kreiranje radnih listova',
                'Sve vrste vježbi za 1.–5. razred',
                'Interaktivno online rješavanje',
                'PDF radni listovi za štampanje, po želji s rješenjima',
            ],
        ],
        'premium' => [
            'name' => 'Premium',
            'description' => 'Sve iz paketa Starter, plus vježbe s vremenskim ograničenjem, dječiji profili i nagrade.',
            'features' => [
                'Sve iz paketa Starter',
                'Historija vježbi',
                'Pokušaji, rezultati i vrijeme rješavanja',
                'timed_exercises' => 'Vježbe s vremenskim ograničenjem',
                'child_profiles' => 'Do 4 dječija profila',
                'rewards' => 'Zvjezdice, sedmični niz i značke',
            ],
        ],
    ],
];
